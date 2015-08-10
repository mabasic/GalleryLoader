<?php

namespace spec\Mabasic\GalleryLoader;

use Illuminate\Filesystem\Filesystem;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Finder\SplFileInfo;

class GalleryLoaderSpec extends ObjectBehavior
{
    /**
     * Create dummy files from array.
     */
    private function createDummyFilesFromArray(array $wannabeFiles)
    {
        return array_map(function ($wannabeFile) {
            // File, RelativePath, RelativePathname
            return new SplFileInfo($wannabeFile, '', $wannabeFile);
        }, $wannabeFiles);
    }

    public function let(Filesystem $filesystem)
    {
        $filesystem->allFiles('/images-empty')->willReturn([]);

        $files = $this->createDummyFilesFromArray(['image.png', 'image2.png', 'test/image34.jpg']);
        $filesystem->allFiles('/images')->willReturn($files);

        $this->beConstructedWith($filesystem);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Mabasic\GalleryLoader\GalleryLoader');
    }

    public function it_returns_an_array_with_images()
    {
        $this->getImages('/images')->shouldHaveCount(3);

        $this->getImages('/images-empty')->shouldHaveCount(0);
    }

    public function it_returns_an_array_with_images_that_do_not_contain_ignore_words()
    {
        $ignoreWords = ['2'];
        $this->getImages('/images', $ignoreWords)->shouldHaveCount(2);
    }

    public function it_returns_image_name_with_a_prefix()
    {
        // File, RelativePath, RelativePathname
        $image = new SplFileInfo('image.png', '', 'image.png');

        $this->getImageNameWithPrefix('large_', $image)->shouldMatch('/large_image.png/');
    }

    public function it_returns_image_name_with_a_suffix()
    {
        // File, RelativePath, RelativePathname
        $image = new SplFileInfo('image.png', '', 'image.png');

        $this->getImageNameWithSuffix($image, '_large')->shouldMatch('/image_large.png/');
    }
}
