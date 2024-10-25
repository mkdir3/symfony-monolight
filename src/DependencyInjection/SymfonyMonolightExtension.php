<?php

declare(strict_types=1);

namespace TenderPanini\SymfonyMonolight\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SymfonyMonolightExtension extends Extension
{
    /**
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $configuration  = new Configuration();
        $config         = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('symfony_monolight.config', $config);
    }
}
