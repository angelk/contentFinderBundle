<?php

namespace Potaka\ContentFinderBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('potaka_content_finder');

        $rootNode->children()
                    ->arrayNode('services')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('name')->end()
                                ->scalarNode('fileFinder')->end()
                                ->scalarNode('contentFinder')->end()
                            ->end()
                        ->end()
                    ->end()
                 ->end();

        return $treeBuilder;
    }
}
