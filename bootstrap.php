<?php

use Symfony\Component\Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

(new Dotenv())->loadEnv(__DIR__ . '/.env');

$_SERVER += $_ENV;
$_SERVER['ARGON_ENV'] = $_ENV['ARGON_ENV'] = ($_SERVER['ARGON_ENV'] ?? $_ENV['ARGON_ENV'] ?? null) ?: 'dev';
$_SERVER['ARGON_DEBUG'] = $_ENV['ARGON_DEBUG'] = (int) ($_SERVER['ARGON_DEBUG'] ?? $_ENV['ARGON_DEBUG'] ?? '0') ? '1' : '0';
