<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Argon\Controller\PageController;

return function(RoutingConfigurator $routes) {
    $routes
        ->add('homepage', '/')
        ->controller([PageController::class, 'homepage'])
        ->methods(['GET'])
    ;
};