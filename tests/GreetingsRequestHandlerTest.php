<?php

declare(strict_types=1);

namespace Scheduler\Tests;


use GuzzleHttp\Psr7\ServerRequest;
use Scheduler\Api\Greetings\SayHelloRequestHandler;


class GreetingsRequestHandlerTest extends KernelTestCase
{
    /**
     * @var SayHelloRequestHandler
     */
    private mixed $sayHelloReqHandler;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sayHelloReqHandler = static::$container->get(SayHelloRequestHandler::class);
    }

    public function testGreetings(): void
    {
        $request = new ServerRequest('GET', '/greetings');
        $request = $request->withQueryParams(['name' => 'john']);

        $response = $this->sayHelloReqHandler->handle($request);

        $this->assertEquals(
            '{"message":"Hello john"}',
            $response->getBody()->getContents());
    }
}