<?php

namespace Potaka\ContentFinderBundle\Finder\File;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface FileFinderInterface
{
    /**
     * @return \SplFileInfo[]
     */
    public function find();
}
