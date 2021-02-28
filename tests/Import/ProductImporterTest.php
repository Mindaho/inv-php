<?php

use App\Import\Converter\CsvToArray;
use App\Import\Importer;
use App\Import\ProductImport;
use App\Model\Product;
use PHPUnit\Framework\TestCase;
use \App\Import\Serializer\BaseSerializer;

class ProductImporterTest extends TestCase
{
    private const INPUT_01_CSV = 'tests/fixtures/input_01.csv';

    private ?Importer $importer;

    protected function setUp(): void
    {
        $this->importer = new Importer(new BaseSerializer(), new CsvToArray());
    }

    public function testProductImport(): void
    {
        $results = $this->importer->import(self::INPUT_01_CSV, new ProductImport());

        $this->assertCount(5, $results);

        $this->assertEquals('mbp', $results[0]->getCode());
        $this->assertEquals('Macbook Pro', $results[0]->getName());
        $this->assertEquals(2, $results[0]->getQuantity());
        $this->assertEquals('29.99', $results[0]->getPrice());
        $this->assertEquals('EUR', $results[0]->getCurrency());

        $this->assertEquals('len', $results[3]->getCode());
        $this->assertEquals('Lenovo P1', $results[3]->getName());
        $this->assertEquals(8, $results[3]->getQuantity());
        $this->assertEquals('60.33', $results[3]->getPrice());
        $this->assertEquals('USD', $results[3]->getCurrency());

        /**
         * @var Product $product
         */
        foreach ($results as $product) {
            $this->assertTrue($product->isValid());
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->importer = null;
    }
}