<?php

namespace Mabasic\GalleryLoader\Facades;

use Illuminate\Support\Facades\Facade;

class GalleryLoader extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'galleryloader';
    }

}

