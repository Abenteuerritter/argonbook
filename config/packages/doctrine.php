<?php

$container->loadFromExtension('doctrine', [
    'dbal' => [
        'url' => '%env(DATABASE_URL)%',
        'charset' => 'UTF8',
    ],
    'orm' => [
        'auto_generate_proxy_classes' => "%kernel.debug%",
        'naming_strategy' => 'doctrine.orm.naming_strategy.underscore_number_aware',
        //'auto_mapping' => true,
        'mappings' => [
            'gedmo_translatable' => [
                'type' => 'annotation',
                'dir' => "%kernel.project_dir%/vendor/gedmo/doctrine-extensions/lib/Gedmo/Translatable/Entity",
                'prefix' => 'Gedmo\Translatable\Entity',
                'is_bundle' => false,
            ],
            'argon_blog' => [
                'type' => 'staticphp',
                'dir' => "%kernel.project_dir%/src/Entity/Blog",
                'prefix' => 'Argon\Entity\Blog',
                'is_bundle' => false,
            ],
        ],
    ],
]);