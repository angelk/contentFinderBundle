<?php

namespace Potaka\ContentFinderBundle\Finder\File;

/**
 * Description of SymfonyFinderAdapter
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SymfonyFinderAdapter implements FileFinderInterface
{
    /**
     * {@inheritdoc}
     */
    public function find($directories)
    {
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->files()->in($directories);
        $return = [];
        foreach ($finder as $file) {
            $return[] = $file;
        }
        
        return $return;
    }
}
