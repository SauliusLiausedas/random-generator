<?php

namespace App\Tests;

use App\Converters\Rot13Converter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Rot13Converter::class)]
class Rot13ConverterTest extends TestCase
{
    #[DataProvider('convertDataProvider')]
    public function testConvert(array $inputs, array $expected): void
    {
        $converter = new Rot13Converter();
        $this->assertEquals($expected, $converter->convert($inputs));
    }

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
