<?php

namespace Test\ContentFinderBundle\Finder\Content;

use PHPUnit_Framework_TestCase;
use Potaka\ContentFinderBundle\Finder\Content\SimpleInefficientContentFinder;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SimpleInefficientContentFinderTest extends PHPUnit_Framework_TestCase
{
    public function testSuccessfulCheckFile()
    {
        $checker = new SimpleInefficientContentFinder();
        $splFile = new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'SimpleInefficientContentFinder' . DIRECTORY_SEPARATOR . 'fileContainsWww');
        $this->assertTrue($checker->checkFile($splFile, 'www'));
    }
    
    public function testUnsuccessfulCheckFile()
    {
        $checker = new SimpleInefficientContentFinder();
        $splFile = new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'SimpleInefficientContentFinder' . DIRECTORY_SEPARATOR . 'fileContainsWww');
        $this->assertFalse($checker->checkFile($splFile, 'this-is-not-in-file'));
    }
}
