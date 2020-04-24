<?php

$container->loadFromExtension('monolog', [
    'handlers' => [
        'main' => [
            'type' => 'fingers_crossed',
            'action_level' => 'error',
            'handler' => 'nested',
        ],
        'nested' => [
            'type' => 'stream',
            'path' => "%kernel.logs_dir%/%kernel.environment%.log",
            'level' => 'debug',
        ],
        'console' => [
            'type' => 'console',
        ],
    ],
]);