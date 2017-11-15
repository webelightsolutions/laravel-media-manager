<?php

namespace Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

use Webelightdev\LaravelMediaManager\src\Helpers\HelperFile;
use Webelightdev\LaravelMediaManager\src\Exceptions\FileCannotBeAdded;

class FileIsTooBig extends FileCannotBeAdded
{
    public static function create($mediaSize)
    {
        $fileSize = HelperFile::getHumanReadableSize($mediaSize);

        $maxFileSize = HelperFile::getHumanReadableSize(config('mediaManager.max_file_size'));

        return new static("File has a size of {$fileSize} which is greater than the maximum allowed {$maxFileSize}");
    }
}
