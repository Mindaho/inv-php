<?php

namespace App\Import;

interface ImportInterface
{
    public function getSerializeType(): string;
}