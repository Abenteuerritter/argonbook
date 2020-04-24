<?php

$container->loadFromExtension('fos_user', [
    'db_driver' => 'orm',
    'firewall_name' => 'main',
    'user_class' => Argon\UserBundle\Entity\Player::class,
    'from_email' => [
        'address' => 'no-reply@argonbook.eu',
        'sender_name' => 'Argonbook',
    ],
    'profile' => [
        'form' => [
            'type' => Argon\UserBundle\Form\Type\ProfileFormType::class,
        ],
    ],
]);