<?php

namespace App\Tests;

use App\Generators\RandomStringGenerator;
use App\Generators\StringGeneratorTrait;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(StringGeneratorTrait::class)]
#[CoversClass(RandomStringGenerator::class)]
class RandomStringGeneratorTest extends TestCase
{
    #[DataProvider('generateDataProvider')]
    public function testGenerate(int $stringLength): void
    {
        $generator = new RandomStringGenerator($stringLength);
        $result = $generator->generate();

        $this->assertIsString($result);
        $this->assertEquals($stringLength, strlen($result));
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9]+$/', $result);
    }

    public static function generateDataProvider(): array
    {
        return [
            'Length 5' => [5],
            'Length 10' => [10],
            'Length 100' => [100],
            'Length 999' => [999],
        ];
    }
}
