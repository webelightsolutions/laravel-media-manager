<?php

namespace  Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;

use Exception;
use Webelightdev\LaravelMediaManager\Exceptions\FileCannotBeAdded;

class MediaCannotBeDeleted extends Exception
{
    public static function doesNotBelongToModel($mediaId)
    {
        return new static("Media with id `{$mediaId}` cannot be deleted because it does not exist");
    }
}
