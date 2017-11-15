<?php

namespace Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

class MimeTypeNotAllowed extends FileCannotBeAdded
{
    public static function create($mimeType, array $allowedMimeTypes)
    {
        $allowedMimeTypes = implode(', ', $allowedMimeTypes);
        return new static("File has a mimetype of {$mimeType}, while only {$allowedMimeTypes} are allowed");
    }
}
