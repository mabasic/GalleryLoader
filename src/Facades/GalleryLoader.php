<?php namespace Mabasic\GalleryLoader\Facades\GalleryLoader;

use Illuminate\Support\Facades\Facade;

class GalleryLoaderFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'galleryloader';
    }

}

