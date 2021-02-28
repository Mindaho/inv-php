<?php

namespace App\Import;

use App\Model\Product;

class ProductImport implements ImportInterface
{
    private const DESERIALIZE_TYPE = Product::class;

    public function getSerializeType(): string
    {
        return self::DESERIALIZE_TYPE;
    }
}