<?php

use App\Import\Serializer\BaseSerializer;
use App\Model\Product;
use PHPUnit\Framework\TestCase;

class BaseSerializerTest extends TestCase
{
    private ?BaseSerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new BaseSerializer();
    }

    public function testConvert()
    {
        $data = [
            ['code' => 'mbp', 'name' => 'Macbook Pro', 'quantity' => 2, 'price' => 29.99, 'currency' => 'EUR'],
            ['code' => 'len', 'name' => 'Lenovo P1', 'quantity' => 8, 'price' => 60.33, 'currency' => 'USD'],
        ];

        $result = $this->serializer->deserialize($data, Product::class);

        $this->assertCount(2, $result);

        $this->assertEquals('mbp', $result[0]->getCode());
        $this->assertEquals('Macbook Pro', $result[0]->getName());
        $this->assertEquals(2, $result[0]->getQuantity());
        $this->assertEquals('29.99', $result[0]->getPrice());
        $this->assertEquals('EUR', $result[0]->getCurrency());

        $this->assertEquals('len', $result[1]->getCode());
        $this->assertEquals('Lenovo P1', $result[1]->getName());
        $this->assertEquals(8, $result[1]->getQuantity());
        $this->assertEquals('60.33', $result[1]->getPrice());
        $this->assertEquals('USD', $result[1]->getCurrency());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->serializer = null;
    }
}