<?php

namespace Argon\GameBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class ArgonGameExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services/forms.xml');
        $loader->load('services/games.xml');
        $loader->load('services/listeners.xml');
        $loader->load('services/security.xml');
        $loader->load('services/transformers.xml');
        $loader->load('services/validators.xml');
    }
}