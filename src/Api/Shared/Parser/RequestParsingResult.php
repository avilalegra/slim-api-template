<?php

declare(strict_types=1);

namespace Scheduler\Api\Shared\Parser;

/**
 * @template T
 */
class RequestParsingResult
{
    /**
     * @param T $data
     * @param array $errors
     */
    private function __construct(
        private $data,
        private readonly array $errors
    )
    {
    }

    public static function ok($data): self
    {
        return new self($data, []);
    }

    public static function failed(array $errors): self
    {
        return new self(null, $errors);
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}