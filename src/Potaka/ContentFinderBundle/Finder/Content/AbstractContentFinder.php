<?php

namespace Potaka\ContentFinderBundle\Finder\Content;

/**
 * Description of AbstractContentFinder
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
abstract class AbstractContentFinder implements ContentFinderInterface
{
    protected $filter;
    
    public function __construct($filter)
    {
        $this->filter = $filter;
    }
}
