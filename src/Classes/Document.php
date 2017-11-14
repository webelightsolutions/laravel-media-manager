<?php

namespace Webelightdev\LaravelMediaManager\src\Classes;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use  Webelightdev\LaravelMediaManager\src\MediaDocument;

class Document {
    public function storeMedia($media, $storage)
    {
           $mediaName = $media['file']->getClientOriginalName();
           $path = $media['directory'].'/documents/';
            $storage->put($path.$mediaName, File::get($media['file']));
            DB::beginTransaction();
            try{
                MediaDocument::create([
                    'name' => $mediaName,
                    'path' =>$path,
                ]);
              } catch (\Illuminate\Database\QueryException $e) {
                DB::rollback();
                return response()->json(['message' => $e->getMessage()]);
            }
            DB::commit();
             return response()->json(['message' => 'Document stored successfully.']);
    }
}