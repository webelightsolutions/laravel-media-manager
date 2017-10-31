<?php

namespace Webelightdev\LaravelMediaManager\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Webelightdev\LaravelMediaManager\Model\MediaImage;
use Webelightdev\LaravelMediaManager\Model\MediaDocument;
use Intervention\Image\ImageManagerStatic as Image;

class MediaController extends Controller
{
    public function create()
    {
        $directoryLists = Storage::disk('public')->directories();
        return view('laravel-mediaManager::create', compact('directoryLists'));
    }

    public function store(Request $request)
    {
       //dd($request->all());
        $directoryName = '';
        $imageTypes = ['original', 'medium', 'small','extra_small'];
        if($request->file('photos')){
            $originalImages = $request->file('photos');
            $imageVarients = $request->images;
            if($request->directory_lists){
                $directoryName = $request->directory_lists;
            } 
            if($request->create_directory){
                $directoryName = $request->create_directory;
            } 
            $this->createDirectories($directoryName, $imageTypes);
            $this->imagesResize($imageVarients, $originalImages, $imageTypes, $directoryName);
        } 

        if($request->file('documents')){
            $originalDocuments = $request->file('documents');

            if($request->directory_lists){
                $directoryName = $request->directory_lists;
            } else if($request->create_directory){
                $directoryName = $request->create_directory;
            } else {
                // Error
            }

            Storage::disk('public')->makeDirectory($directoryName.'/documents/');
            $this->storeDocuments($originalDocuments, $directoryName);
           
        }
    }

    public function createDirectories($directoryName, $imageTypes)
    {
        foreach ($imageTypes as $key => $imageType) {
            Storage::disk('public')->makeDirectory($directoryName.'/images/'."/$imageType/");
        }
    }

    public function imagesResize($imageVarients, $originalImages, $imageTypes, $directoryName)
    {
        foreach ($originalImages as $originalImage) {
            $orignalImageName = $originalImage->getClientOriginalName();
            $original_path = $directoryName.'/images/original/';
            $medium_path = $directoryName.'/images/medium/';
            $small_path = $directoryName.'/images/small/';
            $extraSmall_path = $directoryName.'/images/extra_small/';
            $newImage = Image::make($originalImage);
            $newImage->backup();
            foreach ($imageTypes as $key => $imageType) {
                $newImage->reset()->resize($imageVarients[$imageType]['img_width'], $imageVarients[$imageType]['img_height'], function ($constraint) {
                       $constraint->aspectRatio();
                    });
                if(array_has($imageVarients[$imageType], 'include_canvas') && $imageVarients[$imageType]['include_canvas'] == 1){
                    $newImage->resizeCanvas($imageVarients[$imageType]['img_canvas_width'], $imageVarients[$imageType]['img_canvas_height'], 'center', false, $imageVarients[$imageType]['img_canvas_color']);
                }
                $newImage->save();
                Storage::disk('public')->put($directoryName.'/images/'."/$imageType/".$orignalImageName, $newImage);
            }
            DB::beginTransaction();
            try{
                MediaImage::create([
                    'name' => $orignalImageName,
                    'original_path' =>$original_path,
                    'medium_path' =>$medium_path,
                    'small_path' =>$small_path,
                    'extraSmall_path' =>$extraSmall_path,
                ]);
              } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                return Response::json($e->getMessage() , 422);
            }
            DB::commit();
            return Response::json("Data Saved SuccessFully", 200);
        }
    }

    public function storeDocuments($originalDocuments, $directoryName)
    {
       foreach ($originalDocuments as $originalDocument) {
           $originalDocumentName = $originalDocument->getClientOriginalName();
           $temp = explode(".", $originalDocumentName);
           $documentType = end($temp);
           $allowedExts = array("txt","pdf","doc","docx","ppt", "xlsx");
           $path = $directoryName.'/documents/';
           if(in_array($documentType, $allowedExts)){
               Storage::disk('public')->put($directoryName.'/documents/'.$originalDocumentName, File::get($originalDocument));
            } else {
                //Error
            }
            DB::beginTransaction();
            try{
                MediaDocument::create([
                    'name' => $originalDocumentName,
                    'path' =>$path,
                ]);
              } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                return Response::json($e->getMessage() , 422);
            }
            DB::commit();
            return Response::json("Data Saved SuccessFully", 200);
        }
    }
}
