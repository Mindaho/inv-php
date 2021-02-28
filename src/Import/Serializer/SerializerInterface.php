<?php

namespace App\Import\Serializer;

interface SerializerInterface
{
    public function deserialize(array $rows, string $class);
}