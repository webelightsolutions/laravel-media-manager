<?php
return [
	/*
	 * filesystem disk
	 */
	'storage' => 'public',

	 /*
		|--------------------------------------------------------------------------
		| Media Types
		|--------------------------------------------------------------------------
		|
		| Determine media type keys here for the file mime types which will be
	    | used for auto determining. These keys should correspond to the key
	    | properties that are defined in the media models.
		|
		*/
	    'media_types' => [
	        'audio'    => [
	            'audio/aac', 'audio/mp4', 'audio/mpeg', 'audio/ogg', 'audio/wav', 'audio/webm'
	        ],
	        'document' => [
	            'text/plain', 'application/pdf', 'application/msword', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint',
	            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
	            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
	        ],
	        'image'    => [
	            'image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'
	        ],
	        'video'    => [
	            'video/mp4', 'video/ogg', 'video/webm'
	        ]
	    ],

	    /*
	    	|--------------------------------------------------------------------------
	    	| Model Types
	    	|--------------------------------------------------------------------------
	    	|
	    	| You may define the media models which correspond to the media types here.
	    	|
	    	*/
	        'media_classes' => [
	            'audio'    => Webelightdev\LaravelMediaManager\src\Classes\Audio::class,
	            'document' => Webelightdev\LaravelMediaManager\src\Classes\Document::class,
	            'image'    => Webelightdev\LaravelMediaManager\src\Classes\Image::class,
	            'video'    => Webelightdev\LaravelMediaManager\src\Classes\Video::class
	        ]
];