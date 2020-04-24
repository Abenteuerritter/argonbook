<?php

$container->loadFromExtension('stof_doctrine_extensions', [
    'default_locale' => "%locale%",
    'orm' => [
        'default' => [
            'sluggable' => true,
            'translatable' => true,
            'tree' => true,
            'timestampable' => true,
        ],
    ],
]);