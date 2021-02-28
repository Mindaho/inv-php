<?php

namespace App\Currencies;

use App\Currencies\Calculators\BcCalculator;
use App\Currencies\Calculators\CalculatorInterface;

class Money
{
    use MoneyFactory;

    private string $amount;
    private Currency $currency;

    private static CalculatorInterface $calculator;

    private static array $calculators = [
        BcCalculator::class
    ];

    public function __construct(string $amount, Currency $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    private function newInstance($amount): Money
    {
        return new self($amount, $this->currency);
    }

    public function add(Money ...$addends): Money
    {
        $amount = $this->amount;
        $calculator = $this->getCalculator();

        foreach ($addends as $addend) {
            if (!$this->isSameCurrency($addend)) {
                throw new \InvalidArgumentException('Currencies must match!');
            }

            $amount = $calculator->add($amount, $addend->amount);
        }

        return new self($amount, $this->currency);
    }

    public function subtract(Money ...$subtrahends): Money
    {
        $amount = $this->amount;
        $calculator = $this->getCalculator();

        foreach ($subtrahends as $subtrahend) {
            if (!$this->isSameCurrency($subtrahend)) {
                throw new \InvalidArgumentException('Currencies must match!');
            }

            $amount = $calculator->subtract($amount, $subtrahend->amount);
        }

        return new self($amount, $this->currency);
    }

    public function multiply(string $multiplier): Money
    {
        $product = $this->getCalculator()->multiply($this->amount, $multiplier);

        return $this->newInstance($product);
    }

    public function divide(string $divisor): Money
    {
        if ($this->getCalculator()->compare($divisor, '0') === 0) {
            throw new \InvalidArgumentException('Division by zero');
        }

        $quotient = $this->getCalculator()->divide($this->amount, $divisor);

        return $this->newInstance($quotient);
    }

    public function isSameCurrency(Money $other): bool
    {
        return $this->currency->equals($other->currency);
    }

    private static function initializeCalculator()
    {

        $calculators = self::$calculators;

        foreach ($calculators as $calculator) {
            if ($calculator::isSupported()) {
                return new $calculator();
            }
        }

        throw new \RuntimeException('No calculators available');
    }

    private function getCalculator(): ?CalculatorInterface
    {
        if (empty(self::$calculator)) {
            self::$calculator = self::initializeCalculator();
        }

        return self::$calculator;
    }
}