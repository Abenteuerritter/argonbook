<?php

namespace Argon\GameBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use Argon\GameBundle\Provider\GameFactoryCompilerPass;

/**
 * Game bundle
 */
class ArgonGameBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(
            new GameFactoryCompilerPass()
        );
    }
}