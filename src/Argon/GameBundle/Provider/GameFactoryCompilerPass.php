<?php

namespace Argon\GameBundle\Provider;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class GameFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $serviceId = 'argon_game.provider.game_factory';

        if (!$container->hasDefinition($serviceId)) {
            return;
        }

        $definition = $container->getDefinition($serviceId);
        $games      = $container->findTaggedServiceIds('argon_game.provider');

        foreach ($games as $id => $attributes) {
            $definition->addMethodCall('addGame', array(
                new Reference($id),
            ));
        }
    }
}