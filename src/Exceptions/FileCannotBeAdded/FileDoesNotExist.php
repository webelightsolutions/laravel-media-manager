<?php

namespace Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;

class FileDoesNotExist extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("File does not exist");
    }
}
