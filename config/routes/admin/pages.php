<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

use Argon\Controller\AdminController;

return function(RoutingConfigurator $routes) {
    $routes
        ->add('admin_dashboard', '/')
        ->controller([AdminController::class, 'dashboard'])
        ->methods(['GET'])
    ;
    $routes
        ->add('admin_sink', '/sink')
        ->controller([AdminController::class, 'sink'])
        ->methods(['GET'])
    ;
};