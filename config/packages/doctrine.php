<?php

use DI\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;

return function (Container $container): void {
    $paths = [__DIR__ . '/../../src/'];
    $isDevMode = $_ENV['APP_ENV'] === 'dev';

    $dsnParser = new DsnParser();
    $connectionParams = $dsnParser->parse($_ENV['DATABASE_URL']);

    $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
    $connection = DriverManager::getConnection($connectionParams, $config);
    $entityManager = new EntityManager($connection, $config);

    $container->set(EntityManagerInterface::class, $entityManager);
};


