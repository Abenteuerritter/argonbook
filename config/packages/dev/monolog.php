<?php

$container->loadFromExtension('monolog', [
    'handlers' => [
        'main' => [
            'type' => 'stream',
            'path' => "%kernel.logs_dir%/%kernel.environment%.log",
            'level' => 'debug',
            'channels' => ["!event"],
        ],

        'console' => [
            'type' => 'console',
            'channels' => ["!event", "!doctrine"],
        ],
    ],
]);