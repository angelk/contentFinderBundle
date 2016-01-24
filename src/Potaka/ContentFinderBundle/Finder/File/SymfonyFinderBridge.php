<?php

namespace Potaka\ContentFinderBundle\Finder\File;

/**
 * Description of SymfonyFinderBridge
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SymfonyFinderBridge implements FileFinderInterface
{
    protected $directory;
    
    public function __construct($directory)
    {
        $this->directory = $directory;
    }
    
    /**
     * {@inheritdoc}
     */
    public function find()
    {
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->files()->in($this->directory);
        $return = [];
        foreach ($finder as $file) {
            $return[] = $file;
        }
        
        return $return;
    }
}
