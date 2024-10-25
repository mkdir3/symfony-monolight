<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('symfony_monolight');

        $treeBuilder->getRootNode()
            ->children()
                ->arrayNode('default')
                    ->children()
                        ->scalarNode('key')->end()
                        ?->scalarNode('log_directory')->end()
                        ?->scalarNode('log_pattern')->end()
                    ?->end()
                ->end()
                ->arrayNode('custom')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('key')->end()
                            ->scalarNode('log_directory')->end()
                            ->scalarNode('log_pattern')->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('in_use')->defaultValue('default')->end()
            ->end();

        return $treeBuilder;
    }
}
