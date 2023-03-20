<?php

use DI\Container;
use Psr\Log\LoggerInterface;
use Slim\Logger;

return function (Container $container): void {
    $container->set(LoggerInterface::class, $container->get(Logger::class));
};

