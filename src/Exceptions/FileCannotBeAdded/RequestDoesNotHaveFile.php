<?php
namespace Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;

use  Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;
class RequestDoesNotHaveFile extends FileCannotBeAdded
{
    public static function create()
    {
        return new static("The current request does not have a file.");
    }
}
