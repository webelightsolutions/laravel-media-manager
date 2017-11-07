<?php
namespace Webelightdev\LaravelMediaManager\src\Helpers;

use Finfo;

function getMimetype(string $path) : string
{
    $finfo = new Finfo(FILEINFO_MIME_TYPE);
    return $finfo->file($path);
}