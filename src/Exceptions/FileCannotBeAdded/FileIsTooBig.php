<?php

namespace Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelMediaManager\src\Helpers\File;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

class FileIsTooBig extends FileCannotBeAdded
{
    public static function create($mediaSize)
    {
        $fileSize = File::getHumanReadableSize($mediaSize);

        $maxFileSize = File::getHumanReadableSize(config('mediaManager.max_file_size'));

        return new static("File has a size of {$fileSize} which is greater than the maximum allowed {$maxFileSize}");
    }
}
