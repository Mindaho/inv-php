<?php

namespace App\Import;

use App\Import\Converter\ConverterInterface;
use App\Import\Serializer\SerializerInterface;

class Importer
{
    private SerializerInterface $serializer;
    private ConverterInterface $converter;

    public function __construct(SerializerInterface $serializer, ConverterInterface $converter)
    {
        $this->serializer = $serializer;
        $this->converter = $converter;
    }

    public function import(string $fname, ImportInterface $type)
    {
        $data = $this->converter->convert($fname);

        return $this->serializer->deserialize($data, $type->getSerializeType());
    }
}