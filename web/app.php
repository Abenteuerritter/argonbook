<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__ . '/../app/autoload.php';
include_once __DIR__ . '/../var/bootstrap.php.cache';

$apcLoader = new ApcClassLoader('argonbook', $loader);
$apcLoader->register(true);

$loader->unregister();

$kernel = new AppKernel('prod', false);
$kernel = new AppCache($kernel);
$kernel->loadClassCache();

Request::enableHttpMethodParameterOverride();

$response = $kernel->handle($request = Request::createFromGlobals());
$response->send();

$kernel->terminate($request, $response);
