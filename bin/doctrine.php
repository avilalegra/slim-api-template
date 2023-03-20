<?php

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Slim\App;

/** @var App $app */
$app = require_once __DIR__ . '/../bootstrap.php';

$entityManager = $app->getContainer()->get(EntityManagerInterface::class);

$commands = [

];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);



