<?php

namespace Webelightdev\LaravelMediaManager;

use App\BaseModel;

class Media extends BaseModel
{
    protected $table = 'media';
    protected $fillable = ['media_name', 'mime_type', 'path', 'thumbnail_path'];
}
