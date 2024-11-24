<?php

namespace App;

use App\Converters\ConverterInterface;
use App\Generators\GeneratorInterface;

readonly class GeneratorCollection
{
    /**
     * @param GeneratorInterface[] $generators
     * @param ConverterInterface[] $converters
     */
    public function __construct(
        private iterable $generators,
        private iterable $converters,
    ) {
    }

    /**
     * @return array<class-string<GeneratorInterface>, array<string|string[]>>
     */
    public function process(): array
    {
        $result = [];
        foreach ($this->generators as $generator) {
            $converter = $this->getRandomConverter();
            $generatedValue = $generator->generate();
            if (!is_array($generatedValue)) {
                $generatedValue = [$generatedValue];
            }
            $result[get_class($generator)]['generated'] = $generatedValue;
            $result[get_class($generator)]['converted'] = $converter->convert($generatedValue);
        }

        return $result;
    }

    private function getRandomConverter(): ConverterInterface
    {
        $convertersArray = iterator_to_array($this->converters);

        return $convertersArray[array_rand($convertersArray)];
    }
}
