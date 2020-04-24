<?php

$container->setParameter('project', [
    'name' => 'argonbook',
    'version' => "1.26.1",
]);

$container->setParameter('locale', '%env(ARGON_LOCALE)%');
