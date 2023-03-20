<?php

declare(strict_types=1);

namespace Scheduler\Api\Greetings;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Scheduler\Api\Shared\AbstractApiRequestHandler;


class SayHelloRequestHandler extends AbstractApiRequestHandler
{
    public function __construct(
        private readonly GreetingsRequestParser $reqParser
    )
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $parsingResult = $this->reqParser->parseRequest($request);

        if ($parsingResult->hasErrors()) {
            return $this->formErrorsResponse($parsingResult->getErrors());
        }

        return $this->jsonResponse([
            'message' => "Hello {$parsingResult->getData()['name']}"
        ]);
    }
}