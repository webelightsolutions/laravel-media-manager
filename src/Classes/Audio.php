<?php

namespace Webelightdev\LaravelMediaManager\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Webelightdev\LaravelMediaManager\Helpers\HelperFile;

class Audio {
    public function storeMedia($media, $storage)
    {
        $mediaName = HelperFile::getCurrentTimeStemp().'_'.$media['file']->getClientOriginalName();
        $mediaType = $media['file']->getMimeType();
        $path = $media['directory'].'/audio/';
        $storage->put($path.$mediaName, File::get($media['file']));
        return $mediaData = array('media_name' => $mediaName, 'mime_type'=> $mediaType, 'path'=> $path);
    }
}