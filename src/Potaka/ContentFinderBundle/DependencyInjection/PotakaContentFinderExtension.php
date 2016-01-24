<?php

namespace Potaka\ContentFinderBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Reference;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class PotakaContentFinderExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        /*
         * For every bundle-configured service
         * create new real service
         */
        foreach ($config['services'] as $serviceData) {
            $serviceName = $serviceData['name'];
            $fileFinder = $serviceData['fileFinder'];
            $contentFilter = $serviceData['contentFinder'];
            $container->register($serviceName)
                        ->setClass('Potaka\ContentFinderBundle\Finder\Finder')
                        ->setArguments(
                            [
                                new Reference($fileFinder),
                                new Reference($contentFilter),
                            ]
                        );
        }
        
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
