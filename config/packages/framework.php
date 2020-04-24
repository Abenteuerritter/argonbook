<?php

$container->loadFromExtension('framework', [
    'translator' => [
        'fallbacks' => ["%locale%"],
    ],
    'secret' => '%env(ARGON_SECRET)%',
    'router' => [
        'resource' => 'kernel:loadRoutes',
        'type' => 'service',
    ],
    //'validation' => ['enable_annotations' => true],
    //'serializer' => ['enable_annotations' => true],
    'templating' => [
        'engines' => ['twig'],
    ],
    'default_locale' => "%locale%",
    'session' => [
        'handler_id' => 'session.handler.native_file',
        'save_path' => "%kernel.project_dir%/var/sessions/%kernel.environment%",
    ],
    'http_method_override' => true,
    'serializer' => [
        'enabled' => false,
    ],
]);