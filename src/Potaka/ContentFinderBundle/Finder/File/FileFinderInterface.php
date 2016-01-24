<?php

namespace Potaka\ContentFinderBundle\Finder\File;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
interface FileFinderInterface
{
    /**
     * Search given directories.
     * @param mixed $directories Allow each finder to handle array, string,
     *                           etc...
     * @return \SplFileInfo[]
     */
    public function find($directories);
}
