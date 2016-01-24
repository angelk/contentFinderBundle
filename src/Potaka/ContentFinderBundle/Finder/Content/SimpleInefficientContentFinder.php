<?php

namespace Potaka\ContentFinderBundle\Finder\Content;

use SplFileInfo;

/**
 * Description of SimleUnifficientContentFinder
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SimpleInefficientContentFinder implements ContentFinderInterface
{
    /**
     * {@inheritdoc}
     * Check file for content
     */
    public function checkFile(SplFileInfo $file, $content)
    {
        $path = $file->getPathname();
        $fileContent = file_get_contents($path);
        $match = strpos($fileContent, $content);
        if ($match !== false) {
            return true;
        }
        return false;
    }
}
