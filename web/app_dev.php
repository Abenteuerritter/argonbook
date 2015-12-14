<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('192.168.42.1', '127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file.');
}

require __DIR__ . '/../app/autoload.php';

Debug::enable();

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();

$response = $kernel->handle($request = Request::createFromGlobals());
$response->send();

$kernel->terminate($request, $response);
