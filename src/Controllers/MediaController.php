<?php

namespace Webelightdev\LaravelMediaManager\src\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Webelightdev\LaravelMediaManager\src\Controllers\ModelDeterminer;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded\RequestDoesNotHaveFile;


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
            return redirect()->back()->with('error', trans('MediaManager::messages.folder_exists_already'));
        } else {
            $this->storage->makeDirectory($request->folderName);
            return redirect()->back()->with('success', trans('MediaManager::messages.create_new_folder'));
        }
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
        $mediaInstance->storeMedia($request->all(), $this->storage);
        return redirect()->back()->with('success', 'Media Store  SuccessFully.');
    }
}
