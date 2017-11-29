<?php

namespace Webelightdev\LaravelMediaManager;

use Illuminate\Database\Eloquent\Model;

class MediaEntity extends Model
{
    protected $table = 'media_entities';
    protected $fillable = ['entity_id', 'entity_type', 'media_id'];
}
