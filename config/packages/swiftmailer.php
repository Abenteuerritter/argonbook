<?php

$container->loadFromExtension('swiftmailer', [
    'url' => '%env(MAILER_URL)%',
    'spool' => [
        'type' => 'memory',
    ],
]);