<?php

namespace Test\ContentFinderBundle\Command;

use PHPUnit_Framework_TestCase;

use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Bundle\FrameworkBundle\Console\Application;

use Potaka\ContentFinderBundle\Command\FindCommand;
use Potaka\ContentFinderBundle\Finder\Finder;

/**
 * @author po_taka <angel.koilov@gmail.com>
 */
class FindCommandTest extends PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $kernelMockBuilder = $this->getMockBuilder('Symfony\Component\HttpKernel\Kernel');
        $kernelMockBuilder->disableOriginalConstructor();
        $kernelMockBuilder->setMethods(
            [
                'getContainer',
            ]
        );
        $kernelMock = $kernelMockBuilder->getMockForAbstractClass();
        $container = new \Symfony\Component\DependencyInjection\Container();
        
        $finderMockBuilder = $this->getMockBuilder(Finder::class);
        $finderMockBuilder->disableOriginalConstructor();
        $finderMockBuilder->setMethods(['find']);
        $finderMock = $finderMockBuilder->getMock();
        $finderMock->expects($this->once())
                        ->method('find')
                            ->willReturn(
                                [
                                    new \SplFileInfo('testFile'),
                                ]
                            );
        $container->set('myTestService', $finderMock);
        
        $kernelMock->expects($this->any())
                        ->method('getContainer')
                            ->willReturn($container);
        
        $application = new Application($kernelMock);
        $application->add(new FindCommand());
        
        $command = $application->find('potaka:search');
        $commandTester = new CommandTester($command);
        
        $commandTester->execute(
            [
                'service' => 'myTestService',
                'directories' => '/tmp',
                'content' => 'php',
            ]
        );
        
        $this->assertRegExp('/testFile/', $commandTester->getDisplay());
    }
}
