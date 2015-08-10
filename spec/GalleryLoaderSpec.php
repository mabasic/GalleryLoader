<?php

namespace spec\Mabasic\GalleryLoader;

use Illuminate\Filesystem\Filesystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SplFileInfo;

class GalleryLoaderSpec extends ObjectBehavior
{
    /**
     * Create dummy files from array.
     */
    private function createDummyFilesFromArray(array $wannabeFiles)
    {
        return array_map(function($wannabeFile) {
            return new SplFileInfo($wannabeFile);
        }, $wannabeFiles);
    }

    function let(Filesystem $filesystem)
    {
        $filesystem->allFiles('/images-empty')->willReturn([]);

        $files = $this->createDummyFilesFromArray(['image.png', 'image2.png', 'test/image34.jpg']);
        $filesystem->allFiles('/images')->willReturn($files);

        $this->beConstructedWith($filesystem);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Mabasic\GalleryLoader\GalleryLoader');
    }

    function it_returns_an_array_with_images()
    {
        $this->getImages('/images')->shouldHaveCount(3);

        $this->getImages('/images-empty')->shouldHaveCount(0);
    }

    function it_returns_an_array_with_images_that_do_not_contain_ignore_words()
    {
        $ignoreWords = ['2'];
        $this->getImages('/images', $ignoreWords)->shouldHaveCount(2);
    }

    function it_returns_image_name_with_a_prefix()
    {
        $image = new SplFileInfo('image.png');

        $this->getImageNameWithPrefix('large_', $image)->shouldReturn('/large_image.png');
    }

    function it_returns_image_name_with_a_suffix()
    {
        $image = new SplFileInfo('image.png');

        $this->getImageNameWithSuffix($image, '_large')->shouldReturn('/image_large.png');
    }
}
