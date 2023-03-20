<?php

namespace Scheduler\Api\Shared\Parser;

use Psr\Http\Message\ServerRequestInterface;


/**
 * @template T
 */
interface RequestParserInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return RequestParsingResult<T>
     */
    public function parseRequest(ServerRequestInterface $request) : RequestParsingResult;
}