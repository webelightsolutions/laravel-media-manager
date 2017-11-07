<?php

namespace Webelightdev\LaravelMediaManager\src;

use App\BaseModel;

class MediaImage extends BaseModel
{
    protected $table = 'media_images';
    protected $fillable = ['name', 'original_path', 'medium_path', 'small_path', 'extraSmall_path'];
}
