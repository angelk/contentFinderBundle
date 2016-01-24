<?php

namespace Potaka\ContentFinderBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of FindCommand
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class FindCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('potaka:search')
            ->setDescription('You know, search')
            ->addArgument(
                'service',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'directories',
                InputArgument::REQUIRED
            )
            ->addArgument(
                'content',
                InputArgument::REQUIRED
            )
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $searchServiceName = $input->getArgument('service');
        $searchService = $this->getContainer()->get($searchServiceName);
        /* @var $searchService \Potaka\ContentFinderBundle\Finder\Finder */
        $files = $searchService->find(
            $input->getArgument('directories'),
            $input->getArgument('content')
        );

        if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
            $output->writeln('<info>found ' . count($files) . ' files</info>');
        }
        
        foreach ($files as $file) {
            $output->writeln($file->getPathname());
        }
    }
}
