<?php

namespace Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

class FileDoesNotExist extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("File does not exist");
    }
}
