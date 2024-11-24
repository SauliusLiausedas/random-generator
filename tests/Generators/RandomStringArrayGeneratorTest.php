<?php

namespace Tests\Generators;

use App\Generators\RandomStringArrayGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(RandomStringArrayGenerator::class)]
class RandomStringArrayGeneratorTest extends TestCase
{
    #[DataProvider('generateDataProvider')]
    public function testGenerate(int $stringLength, int $arraySize): void
    {
        $generator = new RandomStringArrayGenerator($stringLength, $arraySize);
        $result = $generator->generate();

        $this->assertCount($arraySize, $result);
        foreach ($result as $string) {
            $this->assertEquals($stringLength, strlen($string));
            $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $string);
        }
    }

    /**
     * @return array<string, list<int>>
     */
    public static function generateDataProvider(): array
    {
        return [
            'Length 5, Size 3' => [5, 3],
            'Length 10, Size 1' => [10, 1],
            'Length 8, Size 5' => [8, 5],
            'Length 3, Size 0' => [3, 0],
            'Length 12, Size 2' => [12, 2],
        ];
    }
}
