<?php

$container->loadFromExtension('security', [
    'providers' => [
        'fos_userbundle' => [
            'id' => 'fos_user.user_provider.username_email',
        ],
        'argon_game_character' => [
            'id' => 'argon_game.security.character_provider',
        ],
        'switch_user' => [
            'chain' => [
                'providers' => ['fos', 'argon'],
            ],
        ],
    ],

    'firewalls' => [
        # disables authentication for assets and profiler
        'dev' => [
            'pattern' => '^/(_(error|profiler|wdt)|css|images|js)/',
            'security' => false,
        ],

        'main' => [
            'pattern' => '^/',
            'form_login' => [
                'provider' => 'fos_userbundle',
                'csrf_token_generator' => 'security.csrf.token_manager',
            ],

            'anonymous' => true,
            'logout' => true,
            'logout_on_user_change' => true,

            'switch_user' => [
                'provider' => 'switch_user',
                'parameter' => '_switch',
                'role' => 'ROLE_ALLOWED_TO_SWITCH_CHARACTER',
            ],
        ],
    ],

    'encoders' => [
        FOS\UserBundle\Model\UserInterface::class => [
            'algorithm' => 'bcrypt',
            'cost' => 12,
        ],
        Symfony\Component\Security\Core\User\User::class => [
            'algorithm' => 'bcrypt',
            'cost' => 12,
        ],
    ],

    'role_hierarchy' => [
        'ROLE_PJ' => [],
        'ROLE_PLAYER' => ['ROLE_ALLOWED_TO_SWITCH_CHARACTER'],
        'ROLE_USER' => ['ROLE_PLAYER'],
        'ROLE_DIRECTOR' => ['ROLE_USER'],
        'ROLE_GAMEMASTER' => ['ROLE_USER', 'ROLE_DIRECTOR'],
        'ROLE_SUPER_ADMIN' => [
            'ROLE_USER',
            'ROLE_DIRECTOR',
            'ROLE_GAMEMASTER',
            'ROLE_ALLOWED_TO_SWITCH',
        ],
    ],

    'access_control' => [
        ['path' => '^/login$', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY', 'methods' => ['GET']],
        ['path' => '^/register', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'],
        ['path' => '^/resetting', 'role' => 'IS_AUTHENTICATED_ANONYMOUSLY'],
        ['path' => '^/characters$', 'role' => 'ROLE_PLAYER', 'methods' => ['GET']],
        ['path' => '^/character/[-\w]+\:[-\w]+/', 'role' => 'ROLE_PLAYER'],
        ['path' => '^/new', 'role' => 'ROLE_PLAYER'],
        ['path' => '^/admin', 'role' => 'ROLE_SUPER_ADMIN'],
    ],
]);