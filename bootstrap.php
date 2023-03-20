<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

foreach (glob(__DIR__ . '/config/packages/*.php') as $path) {
    (require $path)($container);
}

(require __DIR__ . '/config/container.php')($container);
$app = AppFactory::createFromContainer($container);

(require __DIR__ . '/config/pipe.php')($app, $container);

return $app;
