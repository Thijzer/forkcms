<?php

// use vendor generated autoloader
$loader = require_once __DIR__ . '/../vendor/autoload.php';

// todo remove coz we out to use config files
Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
// Spoon is not autoloaded via Composer but uses its own old skool autoloader
set_include_path(__DIR__ . '/../vendor/spoon/library' . PATH_SEPARATOR . get_include_path());
require_once 'spoon/spoon.php';

require_once __DIR__ . '/KernelLoader.php';
require_once __DIR__ . '/ApplicationInterface.php';
require_once __DIR__ . '/Kernel.php';
require_once __DIR__ . '/routing.php';
require_once __DIR__ . '/AppKernel.php';
