<?php

namespace App\Converters;

interface ConverterInterface
{
    /**
     * @param string[] $inputs
     * @return string[]
     */
    public function convert(array $inputs): array;
}
