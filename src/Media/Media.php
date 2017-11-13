<?php

namespace Webelightdev\LaravelMediaManager\src\Media;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Media extends Eloquent {

    protected $table = 'media';

    /**
     * The fillable fields for the model.
     *
     * @var array
     */
    protected $fillable = ['extension', 'mimetype', 'size', 'name', 'path', 'metadata'];
}