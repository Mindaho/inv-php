<?php

namespace App\Model;

class Cart
{
    private array $cartItems;

    public function __construct(Product ...$product)
    {
        $this->cartItems = $product;
    }

    public function add(Product $product): void
    {
        $this->cartItems[] = $product;
    }

    public function all(): array
    {
        return $this->cartItems;
    }
}