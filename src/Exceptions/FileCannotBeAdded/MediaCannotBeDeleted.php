<?php

namespace  Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use Exception;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

class MediaCannotBeDeleted extends Exception
{
    public static function doesNotBelongToModel($mediaId)
    {
        return new static("Media with id `{$mediaId}` cannot be deleted because it does not exist");
    }
}
