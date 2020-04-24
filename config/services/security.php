<?php

$container->register('security.user.provider.concrete.fos', [
    'alias' => 'fos_user.user_provider.username_email',
]);

$container->register('security.user.provider.concrete.argon', [
    'alias' => 'argon_game.security.character_provider',
]);
