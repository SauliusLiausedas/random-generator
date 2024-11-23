<?php

namespace App\Generators;

trait StringGeneratorTrait
{
    private function generateRandomString(int $length): string
    {
        $characters = array_merge(
            range('a', 'z'),
            range('A', 'Z'),
            range('0', '9')
        );

        $charactersLength = count($characters);
        $randomStringArray = [];
        for ($i = 0; $i < $length; $i++) {
            $randomStringArray[] = $characters[random_int(0, $charactersLength - 1)];
        }

        return implode('', $randomStringArray);
    }
}
