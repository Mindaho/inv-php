<?php

use App\Import\Converter\CsvToArray;
use PHPUnit\Framework\TestCase;

class CsvToArrayTest extends TestCase
{
    private const INPUT_01_CSV = 'tests/fixtures/input_01.csv';

    private ?CsvToArray $converter;

    protected function setUp(): void
    {
        $this->converter = new CsvToArray();
    }

    public function testConvert()
    {
        $result = $this->converter->convert(self::INPUT_01_CSV);

        $this->assertCount(5, $result);
        $this->assertEquals('mbp', $result[0]['code']);
        $this->assertEquals('Macbook Pro', $result[0]['name']);
        $this->assertEquals('2', $result[0]['quantity']);
        $this->assertEquals('29.99', $result[0]['price']);
        $this->assertEquals('EUR', $result[0]['currency']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->converter = null;
    }
}