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
            $files = $this->removeFilesThatContainIgnoreWords($files, $ignoreWords);
        }

        sort($files);

        return $files;
    }

    /**
     * Remove files that contain ignore words from the list of files.
     *
     * @param $files
     * @param $ignoreWords
     * @return mixed
     */
    private function removeFilesThatContainIgnoreWords(array $files, array $ignoreWords)
    {
        return $files = array_filter($files, function (SplFileInfo $file) use ($ignoreWords) {
            foreach ($ignoreWords as $ignoreWord) {
                // If ignore word is found in filename remove that file from files
                if (strpos($file->getFilename(), $ignoreWord) !== false) {
                    return false;
                }
            }

            return true;
        });
    }
}
