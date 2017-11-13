<?php

namespace Webelightdev\LaravelMediaManager\src\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use  Webelightdev\LaravelMediaManager\src\MediaDocument;
use Illuminate\Support\Facades\Response;

class Document {
public function storeMedia($originalDocument, $directory, $storageDisk)
{
       $originalDocumentName = $originalDocument->getClientOriginalName();
       $temp = explode(".", $originalDocumentName);
       $documentType = end($temp);
       $allowedExts = array();
       $path = $directoryName.'/documents/';
       if(in_array($documentType, $allowedExts)){
           $storageDisk->put($path.$originalDocumentName, File::get($originalDocument));
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