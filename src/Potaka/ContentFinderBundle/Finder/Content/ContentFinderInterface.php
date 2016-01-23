<?php

namespace Potaka\ContentFinderBundle\Finder\Content;

use SplFileInfo;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface ContentFinderInterface
{
    public function checkFile(SplFileInfo $file);
}
