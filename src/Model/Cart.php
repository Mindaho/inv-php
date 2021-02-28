<?php

namespace App\Model;

class Cart
{
    private array $cartItems;

    public function __construct(Product ...$product)
    {
        $this->cartItems = $product;
    }

    public function add(Product ...$products): void
    {
        foreach ($products as $product) {
            $this->cartItems[] = $product;
        }
    }

    public function all(): array
    {
        return $this->cartItems;
    }

    //@TODO add remove functionality
}