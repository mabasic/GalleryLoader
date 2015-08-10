# Gallery Loader

[![Build Status](https://travis-ci.org/mabasic/GalleryLoader.svg)](https://travis-ci.org/mabasic/GalleryLoader) 

Laravel facade that gets images from a folder sorted by  filename and filtered.

> This is just a simple wrapper for functionality that I use across many projects.

It enables you to easily grabs images from a folder and create a image gallery.

## Installation

From project root type:

```
composer require mabasic/gallery-loader
```

or in `composer.json` add following  to `require`:

```
"require": {
    "mabasic/gallery-loader": "~1.0"
}
```

Register Service provider in `app.php`:

```
'providers' => [
    ...
    Mabasic\GalleryLoader\GalleryLoaderServiceProvider::class
];
```

Register Facade in `app.php`:

```
'aliases' => [
    ...
    'GalleryLoader' => Mabasic\GalleryLoader\Facades\GalleryLoader::class
];
```

## Usage

#### Get all images from a folder

```
GalleryLoader::getImages(public_path() . '/img/slideshow')
```

#### Get all images except images that contain these words

```
GalleryLoader::getImages(public_path() . '/img/slideshow', ['thumb', 'small', 'thumbnail'])
```