<?php

require_once __DIR__ . '/../app/autoload.php';

chdir(__DIR__);

$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
$kernel = new AppKernel('install', true);
$response = $kernel->handle($request);
if (!$response->getCharset() && $kernel->getContainer()) {
    $response->setCharset($kernel->getContainer()->getParameter('kernel.charset'));
}
$response->send();
$kernel->terminate($request, $response);
