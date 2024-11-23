<?php

namespace App\Converters;

interface ConverterInterface
{
    public function convert(array $inputs): array;
}
