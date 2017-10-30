<?php

namespace Webelightdev\LaravelMediaManager\Facades;

use Illuminate\Support\Facades\Facade;

class MediaManager extends Facade
{
	protected static function getFacadeAccessot()
	{
		return 'media-manager';
	}
}