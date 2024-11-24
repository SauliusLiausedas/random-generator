<?php

namespace Tests\Converters;

use App\Converters\StringPatternConverter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(StringPatternConverter::class)]
class StringPatternConverterTest extends TestCase
{
    /**
     * @param string[] $inputs
     * @param string[] $expected
     */
    #[DataProvider('convertDataProvider')]
    public function testConvert(array $inputs, array $expected): void
    {
        $converter = new StringPatternConverter();
        $this->assertEquals($expected, $converter->convert($inputs));
    }

    /**
     * @return array<string[][]>
     */
    public static function convertDataProvider(): array
    {
        return [
            'Normal mixed input' => [['a1b2c3'], ['/11/22/33']],
            'Only alphabetic characters' => [['abc'], ['/1/2/3']],
            'Only numeric characters' => [['123'], ['123']],
            'Empty string' => [[''], ['']],
            'Mixed upper and lower case' => [['AbC'], ['/1/2/3']],
            'Non-alphabetic and non-numeric characters (ignored)' => [['a!b@c#1'], ['/1/2/31']],
        ];
    }
}
