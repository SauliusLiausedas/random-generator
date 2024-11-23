<?php

namespace App\Converters;

readonly class StringPatternConverter implements ConverterInterface
{
    public function convert(array $inputs): array
    {
        foreach ($inputs as $key => $input) {
            $inputs[$key] = $this->convertSingle($input);
        }

        return $inputs;
    }

    private function convertSingle(string $input): string
    {
        $result = '';
        $input = strtolower($input);
        $length = strlen($input);
        $ordA = ord('a') - 1;

        for ($i = 0; $i < $length; $i++) {
            $char = $input[$i];

            if (ctype_digit($char)) {
                $result .= $char;
            } elseif (ctype_alpha($char)) {
                $number = ord($char) - $ordA;
                $result .= '/' . $number;
            }
        }

        return $result;
    }
}
