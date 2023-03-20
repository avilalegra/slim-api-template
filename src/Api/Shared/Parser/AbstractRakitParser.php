<?php

declare(strict_types=1);

namespace Scheduler\Api\Shared\Parser;

use Psr\Http\Message\ServerRequestInterface;
use Rakit\Validation\Validator;

/**
 * @template T
 */
abstract class AbstractRakitParser implements RequestParserInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return RequestParsingResult<T>
     */
    public function parseRequest(ServerRequestInterface $request): RequestParsingResult
    {
        $validator = new Validator;
        $inputs = $this->inputs($request);
        $validation = $validator->validate($inputs, $this->rules());

        if ($validation->fails()) {
            return RequestParsingResult::failed($validation->errors->toArray());
        }

        return RequestParsingResult::ok($this->okResult($inputs));
    }

    abstract protected function rules(): array;

    protected function inputs(ServerRequestInterface $request): array
    {
        return $request->getParsedBody();
    }

    /**
     * @return T
     */
    protected function okResult(array $inputs)
    {
        return $inputs;
    }
}