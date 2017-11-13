<?php

namespace Webelightdev\LaravelMediaManager\src\Controllers;

class ModelDeterminer {
    /**
     * @var string
     */
    protected $defaultMediaModel;

    /**
     * @var array
     */
    protected $mediaTypes;

    /**
     * @var array
     */
    protected $modelTypes;
    protected $mediaType;
    /**
     * Constructor
     *
     * @param Repository $config
     */
    public function __construct()
    {
        $this->mediaTypes = config('mediaManager.media_types');
        $this->modelTypes = config('mediaManager.media_classes');
    }

    /**
     * Returns the media type for given mimetype
     *
     * @param string $mimetype
     * @return string
     */
    public function getMediaType($mimetype)
    {
        foreach ($this->mediaTypes as $type => $mimeTypes)
        {
            if (in_array($mimetype, $mimeTypes))
            {
                $this->mediaType = $type;
                return $this;
            }
        }

        return null;
    }

    /**
     * Returns the model class name for given type
     *
     * @param string $type
     * @return string
     */
    public function getMediaClass()
    {
        return isset($this->modelTypes[$this->mediaType]) ? $this->modelTypes[$this->mediaType] : $this->getDefaultMediaModelName();
    }

    /**
     * Returns the default media model class path
     *
     * @return string
     */
    public function getDefaultMediaModelName()
    {
        return $this->defaultMediaModel;
    }

}