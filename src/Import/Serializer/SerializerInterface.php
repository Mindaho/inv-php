<?php

namespace App\Import\Serializer;

/**
 * Allows implementation of multiple deserializers
 */
interface SerializerInterface
{
    public function deserialize(array $rows, string $class);
}