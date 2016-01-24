<?php

namespace Test\ContentFinderBundle\Command;

use PHPUnit_Framework_TestCase;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Potaka\ContentFinderBundle\Command;

/**
 * Description of FindCommandTest
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class FindCommandTest extends PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $kernelMockBuilder = $this->getMockBuilder(\Symfony\Component\HttpKernel\HttpKernel::class);
        $kernelMockBuilder->disableOriginalConstructor();
        
        $kernelMock = $kernelMockBuilder->getMock();
        
        $application = new Application($kernelMock);
    }
}
