<?php

namespace App\Currencies;

/**
 *
 * Allows us to keep on adding new currencies in an easy way
 *
 * @method static Money EUR(string $amount)
 * @method static Money USD(string $amount)
 * @method static Money GBP(string $amount)
 */
trait MoneyFactory
{
    public static function __callStatic($method, $arguments) : Money
    {
        return new Money($arguments[0], new Currency($method));
    }
}