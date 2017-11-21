<?php

namespace Webelightdev\LaravelMediaManager\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Translation\Loader;
use Webelightdev\LaravelMediaManager\Media;
use Webelightdev\LaravelMediaManager\Controllers\ModelDeterminer;
use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded\MediaCannotBeDeleted;
use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded\RequestDoesNotHaveFile;


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
            return redirect()->back()->with('error', 'sdfdsfsdf');
        } else {
            $this->storage->makeDirectory($request->folderName);
            return redirect('media/create')->with('success', 'dsfsfsafsaf');
        }
    }
    public function getAllMedia()
    {
        $medias =  $this->media->all();
        foreach ($medias as $media) {
           $media['type'] = explode("/", $media->mime_type)[0];
        }
        return view('MediaManager::index', compact('medias'));
    }
     public function getMediaBySearch(Request $request)
    {
       $keyword = $request->search;
       $medias =  $this->media->Where('mime_type', 'LIKE', "%$keyword%")
                               ->orWhere('path', 'LIKE', "%$keyword%")
                               ->orWhere('media_name', 'LIKE', "%$keyword%")
                               ->get()->all();
        foreach ($medias as $media) {
           $media['type'] = explode("/", $media->mime_type)[0];
        }
        return view('MediaManager::index', compact('medias'));
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
