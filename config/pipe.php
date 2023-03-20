<?php

use Psr\Container\ContainerInterface;
use Scheduler\Api\Greetings\SayHelloRequestHandler;
use Scheduler\Api\Shared\Middleware\ApiExceptionMiddleware;
use Slim\App;

return function(App $app, ContainerInterface $container) : void{

    $app->addBodyParsingMiddleware();
    $app->addMiddleware($container->get(ApiExceptionMiddleware::class));

    $app->get('/greetings', SayHelloRequestHandler::class);
};


