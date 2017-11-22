<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Database\Eloquent\Model;

class ExternalMedia extends Model
{
    protected $table = 'external_media';
    protected $fillable = ['external_id', 'media_id'];
}
