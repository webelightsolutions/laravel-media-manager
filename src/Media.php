<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';
    protected $fillable = ['model_id', 'model_type', 'media_name', 'mime_type', 'path', 'thumbnail_path'];

    public function media()
    {
    	return $this->morphTo();
    }
}
