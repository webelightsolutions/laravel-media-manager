<?php

namespace Webelightdev\LaravelMediaManager\Model;

use App\BaseModel;

class MediaDocument extends BaseModel
{
    protected $table = 'media_documents';
    protected $fillable = ['name', 'path'];
}
