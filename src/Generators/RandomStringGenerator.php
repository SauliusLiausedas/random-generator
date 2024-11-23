<?php

namespace App\Generators;

readonly class RandomStringGenerator implements GeneratorInterface
{
    use StringGeneratorTrait;

    public function __construct(
        private int $stringLength
    ) {
    }

    public function generate(): string
    {
        return $this->generateRandomString($this->stringLength);
    }
}
