<?php

namespace Webelightdev\LaravelMediaManager\src\Helpers;

use Finfo;
use Imagick;

class HelperFile
{
    public static function getHumanReadableSize(int $sizeInBytes) : string
    {
    
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($sizeInBytes == 0) {
            return '0 '.$units[1];
        }

        for ($i = 0; $sizeInBytes > 1024; ++$i) {
            $sizeInBytes /= 1024;
        }

        return round($sizeInBytes, 2).' '.$units[$i];
    }

    public static function getCurrentTimeStemp()
    {
        $currentTimestamp = \Carbon\Carbon::now();
        $currentTimestamp = $currentTimestamp->timestamp;
        return $currentTimestamp;
    }
    public static function getMediaThubnail($mediaName, $path)
    {
        $file = storage_path($path.$mediaName."[0]");
        $thubMedia = new Imagick();
        $thubMedia->setResolution(288,288);
        $thubMedia->readImage($file);
        $thubMedia->setImageFormat('jpeg'); 
        $thubMedia->writeImage($path.'thumbnail/output.jpg');
        $thubMedia->clear(); 
        $thubMedia->destroy();
        /*$thubMedia->resizeImage( 200, 200, imagick::FILTER_LANCZOS, 0);
        $thubMedia->setImageFormat('jpg');
        $thubMedia = $thubMedia->getImageBlob();*/
        header('Content-Type: image/jpeg');
        dd($thubMedia);
        return $thubMedia;
    }
}
