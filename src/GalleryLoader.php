<?php

namespace Mabasic\GalleryLoader;

use Illuminate\Filesystem\Filesystem;
use SplFileInfo;

class GalleryLoader
{

    protected $filesystem;

    /**
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * Get images from a folder.
     *
     * @param $folder
     * @param $ignoreWords
     * @return mixed
     */
    public function getImages($folder, $ignoreWords = null)
    {
        $files = $this->filesystem->allFiles($folder);

        // TODO: Return only images

        if (!is_null($ignoreWords)) {
            $files = $this->removeImagesThatContainIgnoreWords($files, $ignoreWords);
        }

        sort($files);

        return $files;
    }

    /**
     * Remove images that contain ignore words from the list of images.
     *
     * @param $images
     * @param $ignoreWords
     * @return images
     */
    private function removeImagesThatContainIgnoreWords(array $images, array $ignoreWords)
    {
        return $images = array_filter($images, function (SplFileInfo $image) use ($ignoreWords) {
            foreach ($ignoreWords as $ignoreWord) {
                // If ignore word is found in filename remove that image from images
                if (strpos($image->getFilename(), $ignoreWord) !== false) {
                    return false;
                }
            }

            return true;
        });
    }

    /**
     * It returns image name with a prefix.
     *
     * @param $prefix
     * @param SplFileInfo $image
     */
    public function getImageNameWithPrefix($prefix, SplFileInfo $image)
    {
        return $image->getPath() . '/' . $prefix . $image->getBasename();
    }

    /**
     * It returns image name with a suffix before the extension.
     *
     * @param SplFileInfo $image
     * @param $suffix
     */
    public function getImageNameWithSuffix(SplFileInfo $image, $suffix)
    {
        return $image->getPath() . '/' . $image->getBasename('.' . $image->getExtension()) . $suffix . '.' . $image->getExtension();
    }
}
