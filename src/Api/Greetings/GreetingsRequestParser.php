<?php

declare(strict_types=1);

namespace Scheduler\Api\Greetings;


use Psr\Http\Message\ServerRequestInterface;
use Scheduler\Api\Shared\Parser\AbstractRakitParser;

/**
 * @extends AbstractRakitParser<array>
 */
class GreetingsRequestParser extends AbstractRakitParser
{
    protected function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    protected function inputs(ServerRequestInterface $request): array
    {
        return $request->getQueryParams();
    }
}