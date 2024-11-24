<?php

namespace Tests;

use App\Converters\ConverterInterface;
use App\Converters\Rot13Converter;
use App\Converters\StringPatternConverter;
use App\GeneratorCollection;
use App\Generators\GeneratorInterface;
use App\Generators\RandomStringArrayGenerator;
use App\Generators\RandomStringGenerator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

#[CoversClass(GeneratorCollection::class)]
class GeneratorCollectionTest extends TestCase
{
    public function testProcess(): void
    {
        $mocks = $this->getMocks();
        $generatorCollection = new GeneratorCollection(
            $mocks[0],
            $mocks[1]
        );

        $result = $generatorCollection->process();

        foreach ($mocks[0] as $key => $generator) {
            $this->assertArrayHasKey('generated', $result[get_class($generator)]);
            $this->assertArrayHasKey('converted', $result[get_class($generator)]);
            $expected = is_array($generator->generate()) ? $generator->generate() : [$generator->generate()];
            $this->assertEquals($expected, $result[get_class($generator)]['generated']);
            $expectedConvert = $mocks[1][$key]->convert($expected);
            $this->assertEquals($expectedConvert, $result[get_class($generator)]['converted']);
        }
    }

    /**
     * @return array{GeneratorInterface[], ConverterInterface[]}
     * @throws Exception
     */
    private function getMocks(): array
    {
        $generatorMock = $this->createMock(RandomStringGenerator::class);
        $generatorMock->method('generate')->willReturn('generatedString');

        $generatorMock1 = $this->createMock(RandomStringArrayGenerator::class);
        $generatorMock1->method('generate')->willReturn(['generated1', 'generated2', 'generated3']);

        $converterMock = $this->createMock(Rot13Converter::class);
        $converterMock1 = $this->createMock(StringPatternConverter::class);
        $map = [
            [['generatedString'], ['convertedString']],
            [['generated1', 'generated2', 'generated3'], ['converted1', 'converted2', 'converted3']]
        ];
        $converterMock->method('convert')
            ->willReturnMap($map);

        $converterMock1->method('convert')
            ->willReturnMap($map);

        return [
            [$generatorMock, $generatorMock1],
            [$converterMock, $converterMock1]
        ];
    }
}
