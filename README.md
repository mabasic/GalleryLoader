# Gallery Loader

[![Build Status](https://travis-ci.org/mabasic/GalleryLoader.svg)](https://travis-ci.org/mabasic/GalleryLoader) [![Latest Stable Version](https://poser.pugx.org/mabasic/gallery-loader/v/stable)](https://packagist.org/packages/mabasic/gallery-loader) [![Total Downloads](https://poser.pugx.org/mabasic/gallery-loader/downloads)](https://packagist.org/packages/mabasic/gallery-loader) [![Latest Unstable Version](https://poser.pugx.org/mabasic/gallery-loader/v/unstable)](https://packagist.org/packages/mabasic/gallery-loader) [![License](https://poser.pugx.org/mabasic/gallery-loader/license)](https://packagist.org/packages/mabasic/gallery-loader)

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

### Helpers

#### `getImageNameWithPrefix($prefix, SplFileInfo $image)`

`image.png` with prefix `thumb_` transforms to `thumb_image.png`.

#### `getImageNameWithSuffix(SplFileInfo $image, $suffix)`

`image.png` with suffix `_thumb` transforms to `image_thumb.png`.

#### `getImageWithSuffix(SplFileInfo $image, $suffix, $folder)`

Returns URL for image with suffix.

#### `getImageWithPrefix(SplFileInfo $image, $prefix, $folder)`

Returns URL for image with prefix.

#### `getImage(SplFileInfo $image, $folder)`

Returns URL for image.

### Real World Example

```
<ul class="slides">
    @foreach(GalleryLoader::getImages(public_path($folder = 'img/paddle/slider/'), ['large']) as $image)
    <li>
        <a href="{{ GalleryLoader::getImageWithSuffix($image, '_large', $folder) }}">
            <img src="{{ GalleryLoader->getImage($image, $folder) }}" />
        </a>
    </li>
    @endforeach
</ul>
```