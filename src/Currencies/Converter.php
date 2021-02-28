<?php

namespace App\Currencies;

//@TODO this class can be completely rewritten. More as an quick n dirty solution..
class Converter
{
    private array $exchange;

    public function __construct(array $exchange)
    {
        $this->exchange = $exchange;
    }

    public function convert(Money $money, Currency $counterCurrency): ?Money
    {
        $baseCurrency = $money->getCurrency();

        if (!$this->contains($counterCurrency)) {
            return null;
        }

        $ratio = $this->quote($counterCurrency, $baseCurrency);

        $counterValue = $money->divide($ratio);

        return new Money($counterValue->getAmount(), $counterCurrency);
    }

    private function contains(Currency $currency)
    {
        return isset($this->exchange[$currency->getCode()]);
    }

    private function quote(Currency $currency, Currency $counterCurrency): string
    {
        return $this->exchange[$currency->getCode()][$counterCurrency->getCode()];
    }

}