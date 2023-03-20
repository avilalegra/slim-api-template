<?php

declare(strict_types=1);

namespace Scheduler\Api\Shared;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class AbstractApiRequestHandler implements RequestHandlerInterface
{
    public function formErrorsResponse($errors): ResponseInterface
    {
        return $this->jsonResponse(data: [
            'message' => 'Invalid data provided',
            'errors' => $errors
        ], status: 400);
    }

    public function jsonResponse($data, int $status = 200, array $headers = []): ResponseInterface
    {
        $headers['Content-Type'] = 'application/json';
        return new Response($status, $headers, json_encode($data));
    }
}