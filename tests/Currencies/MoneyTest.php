<?php

use App\Currencies\Money;
use App\Model\Product;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    public function testProductMoneyConvert()
    {
        $product = new Product();

        $product->setCode('cbl');
        $product->setName('PC Cable');
        $product->setQuantity(2);
        $product->setCurrency('EUR');
        $product->setPrice('11.54');

        $this->assertTrue($product->isValid());

        $C = $product->getCurrency();
        /** @var Money $money */
        $money = Money::$C($product->getPrice());

        $this->assertEquals('EUR', $money->getCurrency()->getCode());
        $this->assertEquals('11.54', $money->getAmount());

        $nM = Money::EUR('54.251');

        $res = $money->add($nM);

        $this->assertEquals('65.79', $res->getAmount());

        // 11.54 / 0.84 = 13.73
        $res = $money->divide('0.84');
        $this->assertEquals('13.73', $res->getAmount());

        // 11.54 / 1.21 = 17.88
        $res = $money->multiply('1.55');
        $this->assertEquals('17.88', $res->getAmount());
    }
}