<?php
namespace Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use  Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;
class RequestDoesNotHaveFile extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("The current request does not have a file.");
    }
}
