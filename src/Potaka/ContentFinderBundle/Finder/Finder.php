<?php

namespace Potaka\ContentFinderBundle\Finder;

use Potaka\ContentFinderBundle\Finder\Content\ContentFinderInterface;
use Potaka\ContentFinderBundle\Finder\File\FileFinderInterface;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class Finder
{
    private $fileFinder;
    private $contentFinder;
    
    public function __construct(FileFinderInterface $fileFilter, ContentFinderInterface $contentFinder)
    {
        $this->fileFinder = $fileFilter;
        $this->contentFinder = $contentFinder;
    }
    
    public function find()
    {
        $return = [];
        foreach ($this->fileFinder->find() as $file) {
            if ($this->contentFinder->checkFile($file)) {
                $return[] = $file;
            }
        }
        
        return $return;
    }
}
