<?php

namespace Test\ContentFinderBundle\Finder;

use PHPUnit_Framework_TestCase;

use SplFileInfo;

use Potaka\ContentFinderBundle\Finder\Finder;
use Potaka\ContentFinderBundle\Finder\File\SymfonyFinderBridge;
use Potaka\ContentFinderBundle\Finder\Content\SimpleInefficientContentFinder;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class FinderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that 2 files are returned by file finder
     * all files are successfuly find by incontentFilter
     */
    public function testFind()
    {
        $fileFinderMockBuilder = $this->getMockBuilder(SymfonyFinderBridge::class);
        $fileFinderMockBuilder->disableOriginalConstructor()
                              ->setMethods(['find']);
        $fileFinderMock = $fileFinderMockBuilder->getMock();
        
        $splFileInfoMock = $this->getMock(SplFileInfo::class, [], [], '', false);
        
        $fileFinderMock->expects($this->once())
                            ->method('find')
                                ->willReturn(
                                    [
                                        $splFileInfoMock,
                                        $splFileInfoMock,
                                    ]
                            );
        
        $contentFinderMockBuilder = $this->getMockBuilder(SimpleInefficientContentFinder::class);
        $contentFinderMockBuilder->disableOriginalConstructor()
                                 ->setMethods(['checkFile']);
        $contentFinderMock = $contentFinderMockBuilder->getMock();
        $contentFinderMock->expects($this->exactly(2))
                            ->method('checkFile')
                                ->willReturn(true);
        
        $finder = new Finder($fileFinderMock, $contentFinderMock);
        $result = $finder->find();
        $this->assertSame(
            [$splFileInfoMock, $splFileInfoMock],
            $result
        );
    }
    
    /**
     * Test that 2 files are returned by file finder
     * none of files are find by incontentFilter
     */
    public function testFindFilteringAllFilesInContentFinder()
    {
        $fileFinderMockBuilder = $this->getMockBuilder(SymfonyFinderBridge::class);
        $fileFinderMockBuilder->disableOriginalConstructor()
                              ->setMethods(['find']);
        $fileFinderMock = $fileFinderMockBuilder->getMock();
        
        $splFileInfoMock = $this->getMock(SplFileInfo::class, [], [], '', false);
        
        $fileFinderMock->expects($this->once())
                            ->method('find')
                                ->willReturn(
                                    [
                                        $splFileInfoMock,
                                        $splFileInfoMock,
                                    ]
                            );
        
        $contentFinderMockBuilder = $this->getMockBuilder(SimpleInefficientContentFinder::class);
        $contentFinderMockBuilder->disableOriginalConstructor()
                                 ->setMethods(['checkFile']);
        $contentFinderMock = $contentFinderMockBuilder->getMock();
        $contentFinderMock->expects($this->exactly(2))
                            ->method('checkFile')
                                ->willReturn(false);
        
        $finder = new Finder($fileFinderMock, $contentFinderMock);
        $result = $finder->find();
        $this->assertSame(
            [],
            $result
        );
    }
}
