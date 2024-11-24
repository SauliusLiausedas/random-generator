<?php

namespace App\Generators;

readonly class RandomStringArrayGenerator implements GeneratorInterface
{
    use StringGeneratorTrait;

    public function __construct(
        private int $stringLength,
        private int $arraySize,
    ) {
    }

    /**
     * @return string[]
     */
    public function generate(): array
    {
        $result = [];
        for ($i = 0; $i < $this->arraySize; $i++) {
            $result[] = $this->generateRandomString($this->stringLength);
        }

        return $result;
    }
}
