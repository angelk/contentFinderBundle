<?php

namespace Potaka\ContentFinderBundle\Finder\Content;

use SplFileInfo;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface ContentFinderInterface
{
    /**
     * Check if file have given content
     * @param SplFileInfo $file
     * @return bool
     */
    public function checkFile(SplFileInfo $file);
}
