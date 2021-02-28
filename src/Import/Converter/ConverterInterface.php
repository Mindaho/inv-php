<?php

namespace App\Import\Converter;

/**
 * Allows us to implement multiple converters if needed
 */
interface ConverterInterface
{
    public function convert(string $fname): array;
}