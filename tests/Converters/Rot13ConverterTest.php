<?php

namespace Tests\Converters;

use App\Converters\Rot13Converter;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Rot13Converter::class)]
class Rot13ConverterTest extends TestCase
{
    /**
     * @param string[] $inputs
     * @param string[] $expected
     * @return void
     */
    #[DataProvider('convertDataProvider')]
    public function testConvert(array $inputs, array $expected): void
    {
        $converter = new Rot13Converter();
        $this->assertEquals($expected, $converter->convert($inputs));
    }

    /**
     * @return array<string[][]>
     */
    public static function convertDataProvider(): array
    {
        return [
            'Normal input' => [['hello'], ['uryyb']],
            'Mixed input' => [['Hello123'], ['Uryyb123']],
            'Empty string' => [[''], ['']],
            'Rot13 of rot13' => [['uryyb'], ['hello']],
            'Special characters' => [['!@#'], ['!@#']],
        ];
    }
}
