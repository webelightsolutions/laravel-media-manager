<?php

namespace Webelightdev\LaravelMediaManager\src\Classes;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use  Webelightdev\LaravelMediaManager\src\MediaImage;
use Illuminate\Support\Facades\Response;

class Image {
	public function storeMedia($media, $storage)
	{
        $mediaName = $media['file']->getClientOriginalName();
        $path = $media['directory'].'/images/';
        $newImage = Images::make($media['file']);
        $newImage->backup();
        //$storage->makeDirectory($path);
        $newImage->reset()->resize($media['imageVarients']['img_width'], $media['imageVarients']['img_height'], function ($constraint) {
                   $constraint->aspectRatio();
        });
        if(array_has($media['imageVarients'], 'include_canvas') && $media['imageVarients']['include_canvas'] == 1){
            $newImage->resizeCanvas($media['imageVarients']['img_canvas_width'], $media['imageVarients']['img_canvas_height'], 'center', false, $media['imageVarients']['img_canvas_color']);
        }
        $newImage->save();
        $storage->put($path.$mediaName, $newImage);
        
        DB::beginTransaction();
        try{
            MediaImage::create([
                'name' => $mediaName,
                'original_path' =>$path,
            ]);
          } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()]);
        }
        DB::commit();
       return response()->json(['message' => 'Image stored successfully.']);
	}
}
