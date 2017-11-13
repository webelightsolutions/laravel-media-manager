<?php

namespace Webelightdev\LaravelMediaManager\src\Classes;

use Intervention\Image\ImageManagerStatic as Images;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use  Webelightdev\LaravelMediaManager\src\MediaImage;
use Illuminate\Support\Facades\Response;

class Image {

	public function storeMedia($imageVarients, $originalImage, $upload_path ,$storageDisk)
	{
	        $orignalImageName = $originalImage->getClientOriginalName();
	        $imageTypes = ['original', 'medium', 'small','extra_small'];
	        $newImage = Images::make($originalImage);
	        $newImage->backup();
	        foreach ($imageTypes as $key => $imageType) {
	            $newImage->reset()->resize($imageVarients[$imageType]['img_width'], $imageVarients[$imageType]['img_height'], function ($constraint) {
	                   $constraint->aspectRatio();
	                });
	            if(array_has($imageVarients[$imageType], 'include_canvas') && $imageVarients[$imageType]['include_canvas'] == 1){
	                $newImage->resizeCanvas($imageVarients[$imageType]['img_canvas_width'], $imageVarients[$imageType]['img_canvas_height'], 'center', false, $imageVarients[$imageType]['img_canvas_color']);
	            }
	            $newImage->save();
	            $storageDisk->put($upload_path.'/images/'."/$imageType/".$orignalImageName, $newImage);
	        }
	        DB::beginTransaction();
	        try{
	            MediaImage::create([
	                'name' => $orignalImageName,
	                'original_path' =>$upload_path.'/images/original/',
	                'medium_path' =>$upload_path.'/images/medium/',
	                'small_path' =>$upload_path.'/images/small/',
	                'extraSmall_path' =>$upload_path.'/images/extra_small/',
	            ]);
	          } catch (\Illuminate\Database\QueryException $e) {
	            DB::rollback();
	            return Response::json($e->getMessage() , 422);
	        }
	        DB::commit();
	        return Response::json("Data Saved SuccessFully", 200);
	   
	}
}
