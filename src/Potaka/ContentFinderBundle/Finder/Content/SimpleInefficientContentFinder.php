<?php

namespace Potaka\ContentFinderBundle\Finder\Content;

use SplFileInfo;

/**
 * Description of SimleUnifficientContentFinder
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SimpleInefficientContentFinder extends AbstractContentFinder
{
    public function checkFile(SplFileInfo $file)
    {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $match = strpos($content, $this->filter);
        if ($match !== false) {
            return true;
        }
        return false;
    }
}
