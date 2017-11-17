<?php

namespace Webelightdev\LaravelMediaManager\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Translation\Loader;
use Webelightdev\LaravelMediaManager\src\Media;
use Webelightdev\LaravelMediaManager\src\Controllers\ModelDeterminer;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\MediaCannotBeDeleted;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\RequestDoesNotHaveFile;


class MediaController extends Controller
{
    protected $fileSystem;
    protected $storage;
    protected $media_types;
    protected $model_type;
    protected $modelDeterminer;

    public function __construct(ModelDeterminer $modelDeterminer, Media $media)
    {
        $this->media = $media;
        $this->modelDeterminer = $modelDeterminer;
        $this->mediaTypes = config('mediaManager.media_types');
        $this->fileSystem      = config('mediaManager.storage');
        $this->mediaClasses = config('mediaManager.media_classes');
        $this->storage = app('filesystem')->disk($this->fileSystem);
    }
    public function create()
    {
        $directories= $this->storage->directories();
        return view('MediaManager::media', compact('directories'));
    }
    public function makeDirectory(Request $request)
    {
        if ($this->storage->exists($request->folderName)) {
            return redirect()->back()->with('error', trans('MediaManager::messages.folder_exists_already'));
        } else {
            $this->storage->makeDirectory($request->folderName);
            return redirect()->back()->with('success', trans('MediaManager::messages.create_new_folder'));
        }
    }
    public function getAllMedia()
    {
        $medias =  $this->media->all();
        return view('MediaManager::index', compact('medias'));
    }
     public function getMediaById($id)
    {
        $media = $this->media->find($id);
        if (!$media) {
            throw FileDoesNotExist::create();
        }
        $media->get();
    }

    public function store(Request $request)
    {
        $media = $request->file('file');
        if (empty($media)) {
            throw RequestDoesNotHaveFile::create();  
        } 
        if (filesize($media) > config('mediaManager.max_file_size')) {
            throw FileIsTooBig::create(filesize($media));
        }
        $mimeType = $media->getMimeType();
        $mediaModelType = $this->modelDeterminer->getMediaType($mimeType)->getMediaClass();
        $mediaInstance = new $mediaModelType;
        $mediaData = $mediaInstance->storeMedia($request->all(), $this->storage);
        if(!empty($mediaData)){
             DB::beginTransaction();
             try{
                $this->media->create($mediaData);
               } catch (\Illuminate\Database\QueryException $e) {
                 DB::rollback();
                 return redirect('media')->with('error', $e->getMessage());
             }
             DB::commit();
             return redirect('media')->with('success','Media stored successfully.');
        }
    }

    public function destroy($id)
    {
        $media = $this->media->find($id);
        if (!$media) {
            throw MediaCannotBeDeleted::doesNotBelongToModel($id);
        }
        $media->delete();
        unlink('storage/'.$media->path.$media->media_name);
        return redirect()->back();
    }
}
