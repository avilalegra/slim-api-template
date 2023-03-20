<?php

declare(strict_types=1);

namespace Scheduler\Tests;

use DI\Container;
use PHPUnit\Framework\TestCase;

class KernelTestCase extends TestCase
{
    protected static Container $container;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::$container = (require __DIR__.'/../bootstrap.php')->getContainer();
    }

}