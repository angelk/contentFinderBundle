<?php

namespace Test\ContentFinderBundle\Finder\File;

use PHPUnit_Framework_TestCase;

use Potaka\ContentFinderBundle\Finder\File\SymfonyFinderAdapter;

/**
 * Description of SymfonyFinderAdapterTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class SymfonyFinderAdapterTest extends PHPUnit_Framework_TestCase
{
    public function testNestedFind()
    {
        $finder = new SymfonyFinderAdapter();
        $files = $finder->find(__DIR__ . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'nested');
        $expectedFoundFile = __DIR__ . DIRECTORY_SEPARATOR . 'tests' . DIRECTORY_SEPARATOR . 'nested'
                . DIRECTORY_SEPARATOR . 'a' . DIRECTORY_SEPARATOR . 'b' . DIRECTORY_SEPARATOR . 'aaa';
        
        $this->assertSame(
            $files[0]->getPathname(),
            $expectedFoundFile
        );
    }
}
