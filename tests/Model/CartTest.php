<?php

use App\Model\Cart;
use App\Model\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddToCart(): void
    {
        $cart = new Cart(new Product(), new Product());

        $cart->add(new Product(), new Product());

        $this->assertCount(4, $cart->all());
    }
}