<?php

namespace App\Currencies\Calculators;

interface CalculatorInterface
{
    public static function isSupported(): bool;

    public function compare(string $a, string $b): int;

    public function add(string $amount, string $addend): string;

    public function subtract(string $amount, string $subtrahend): string;

    public function multiply(string $amount, string $multiplier): string;

    public function divide(string $amount, string $divisor): string;
}