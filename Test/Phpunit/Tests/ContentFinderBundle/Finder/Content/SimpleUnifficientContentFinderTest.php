<?php

namespace Test\ContentFinderBundle\Finder\Content;

use PHPUnit_Framework_TestCase;
use Potaka\ContentFinderBundle\Finder\Content\SimpleUnifficientContentFinder;

/**
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SimpleUnifficientContentFinderTest extends PHPUnit_Framework_TestCase
{
    public function testSuccessfulCheckFile()
    {
        $checker = new SimpleUnifficientContentFinder('www');
        $splFile = new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'SimpleUnifficientContentFinderTest' . DIRECTORY_SEPARATOR . 'fileContainsWww');
        $this->assertTrue($checker->checkFile($splFile));
    }
    
    public function testUnsuccessfulCheckFile()
    {
        $checker = new SimpleUnifficientContentFinder('this-is-not-in-file');
        $splFile = new \SplFileInfo(__DIR__ . DIRECTORY_SEPARATOR . 'SimpleUnifficientContentFinderTest' . DIRECTORY_SEPARATOR . 'fileContainsWww');
        $this->assertFalse($checker->checkFile($splFile));
    }
}
