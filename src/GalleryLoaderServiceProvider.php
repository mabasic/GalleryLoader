<?php

namespace Mabasic\GalleryLoader;

use Illuminate\Support\ServiceProvider;

//use Mabasic\GalleryLoader\GalleryLoader;

class GalleryLoaderServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('galleryloader', function ($app) {
            //return new GalleryLoader();
            return $app->make('Mabasic\GalleryLoader\GalleryLoader');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
