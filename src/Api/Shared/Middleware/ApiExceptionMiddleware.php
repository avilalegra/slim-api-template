<?php

declare(strict_types=1);

namespace Scheduler\Api\Shared\Middleware;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class ApiExceptionMiddleware implements MiddlewareInterface
{
    public function __construct(
        private LoggerInterface $logger
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            $response = ['message' => 'Something bad happend'];

            if (($_ENV['APP_ENV'] ?? '') === 'dev') {
                $response = [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTrace()
                ];
            }

            return new Response(
                status: 500,
                headers: ['Content-Type' => 'application/json'],
                body: json_encode($response));
        }
    }
}