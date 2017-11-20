<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = ['media_name', 'mime_type', 'path', 'thumbnail_path'];
}
