<?php

namespace Webelightdev\LaravelMediaManager\src;

use App\BaseModel;

class Media extends BaseModel
{
    protected $table = 'media';
    protected $fillable = ['media_name', 'mime_type', 'path', 'thumbnail_path'];
}
