<?php

use App\Currencies\Converter;
use App\Currencies\Currency;
use App\Currencies\Money;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    private const EXCHANGE = [
        'EUR' => [
            'USD' => '1.14',
            'GBP' => '0.88'
        ]
    ];

    public function testConverterToEUR(): void
    {
        $converter = new Converter(self::EXCHANGE);

        $EURCur = new Currency('EUR');

        $moneyUSD = Money::USD('115.24');
        $moneyGBP = Money::GBP('115.24');

        $result = $converter->convert($moneyUSD, $EURCur);

        $this->assertEquals('EUR', $result->getCurrency()->getCode());
        $this->assertEquals('101.08', $result->getAmount());

        $result = $converter->convert($moneyGBP, $EURCur);

        $this->assertEquals('EUR', $result->getCurrency()->getCode());
        $this->assertEquals('130.95', $result->getAmount());
    }
}