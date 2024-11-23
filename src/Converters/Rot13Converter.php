<?php

namespace App\Converters;

readonly class Rot13Converter implements ConverterInterface
{
    public function convert(array $inputs): array
    {
        foreach ($inputs as $key => $input) {
            $inputs[$key] = str_rot13($input);
        }

        return $inputs;
    }
}
