<?php

namespace App\Import\Converter;

interface ConverterInterface
{
    public function convert(string $fname): array;
}