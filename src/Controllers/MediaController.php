<?php

namespace Webelightdev\LaravelMediaManager\src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Exception;
use Webelightdev\LaravelMediaManager\src\Controllers\ModelDeterminer;


class MediaController extends Controller
{
    protected $fileSystem;
    protected $storage;
    protected $media_types;
    protected $model_type;
    protected $modelDeterminer;

    public function __construct(ModelDeterminer $modelDeterminer)
    {
        $this->modelDeterminer = $modelDeterminer;
        $this->fileSystem      = config('mediaManager.storage');
        $this->storage = app('filesystem')->disk($this->fileSystem);
        $this->mediaTypes = config('mediaManager.media_types');
        $this->mediaClasses = config('mediaManager.media_classes');
    }
    public function create()
    {
        $directories= $this->storage->directories();
        return view('MediaManager::media', compact('directories'));
    }
    public function makeDirectory(Request $request)
    {
        if ($this->storage->exists($request->folderName)) {
            return redirect('media')->with('error', trans('MediaManager::messages.folder_exists_already'));
        } else {
            foreach ($this->image_types as $key => $imageType) {
                $this->storage->makeDirectory($request->folderName.'/images/'."/$imageType/");
            }
            $this->storage->makeDirectory($request->folderName.'/documents/');
            return redirect('media')->with('success', trans('MediaManager::messages.create_new_folder'));
        }
    }
    public function store(Request $request)
    {
        $directory = $request->directory;
        $media = $request->file('file');
        $mimeType = $media->getMimeType();
        $imageVarients = $request->images;
        $mediaModelType = $this->modelDeterminer->getMediaType($mimeType)->getMediaClass();
        $mediaInstance = new $mediaModelType;
        $mediaInstance->storeMedia($media, $directory, $this->storage);
    }
}
