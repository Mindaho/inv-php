<?php

namespace App\Currencies\Calculators;

use App\Constants\Constants;

class BcCalculator implements CalculatorInterface
{
    private $scale;

    public function __construct($scale = Constants::CURRENCY_SCALE)
    {
        $this->scale = $scale;
    }

    public static function isSupported(): bool
    {
        return extension_loaded('bcmath');
    }

    public function compare(string $a, string $b): int
    {
        return bccomp($a, $b, $this->scale);
    }

    public function add(string $amount, string $addend): string
    {
        return bcadd($amount, $addend, $this->scale);
    }

    public function subtract(string $amount, string $subtrahend): string
    {
        return bcsub($amount, $subtrahend, $this->scale);
    }

    public function multiply(string $amount, string $multiplier): string
    {
        return bcmul($amount, $multiplier, $this->scale);
    }

    public function divide(string $amount, string $divisor): string
    {
        return bcdiv($amount, $divisor, $this->scale);
    }
}