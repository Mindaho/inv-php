<?php

namespace App\Model;

class Cart
{
    private array $orderItems;

    public function __construct(Product ...$product)
    {
        $this->orderItems = $product;
    }

    public function add(Product $product): void
    {
        $this->orderItems[] = $product;
    }

    public function all(): array
    {
        return $this->orderItems;
    }
}