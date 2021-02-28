<?php

namespace App\Currencies;

final class Currency
{
    private string $code;

    public function __construct($code)
    {
        if (!is_string($code)) {
            throw new \InvalidArgumentException('Currencies code should be string');
        }

        if ($code === '') {
            throw new \InvalidArgumentException('Currencies code should not be empty string');
        }

        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function equals(Currency $other): bool
    {
        return $this->code === $other->code;
    }
}