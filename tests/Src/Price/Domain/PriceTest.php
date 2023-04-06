<?php declare(strict_types=1);

namespace Tests\Mercadona\Price\Domain;

use Mercadona\Price\Domain\Iva;
use PHPUnit\Framework\TestCase;
use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceId;
use Tests\Mercadona\Price\Domain\PriceExample;

final class PriceTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $price = PriceExample::dummy();
        $this->assertInstanceOf(Price::class, $price);
    }

    public function testCanGetId(): void
    {
        $price = PriceExample::dummy();
        $this->assertInstanceOf(PriceId::class, $price->id());
        $this->assertSame(1, $price->id()->value());
    }

    public function testCanGetIva(): void
    {
        $price = PriceExample::dummy();
        $this->assertInstanceOf(Iva::class, $price->iva());
        $this->assertSame(4, $price->iva()->value);
    }

    public function testCanGetIsNew(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->isNew());
        $this->assertTrue($price->isNew());
    }

    public function testCanGetIsPack(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->isPack());
        $this->assertFalse($price->isPack());
    }

    public function testCanGetPackSize(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->packSize());
        $this->assertSame(1.2, $price->packSize());
    }

    public function testCanGetUnitName(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsInt($price->unitName());
        $this->assertSame(1, $price->unitName());
    }

    public function testCanGetUnitSize(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->unitSize());
        $this->assertSame(1.0, $price->unitSize());
    }
    public function testCanGetBulkPrice(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->bulkPrice());
        $this->assertSame(10.0, $price->bulkPrice());
    }

    public function testCanGetUnitPrice(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->unitPrice());
        $this->assertSame(10.0, $price->unitPrice());
    }

    public function testCanGetApproxSize(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->approxSize());
        $this->assertTrue($price->approxSize());
    }

    public function testCanGetSizeFormat(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsString($price->sizeFormat());
        $this->assertSame("kg", $price->sizeFormat());
    }

    public function testCanGetTotalUnits(): void
    {
        $price = PriceExample::dummy();
        $this->assertSame(null, $price->totalUnits());
    }

    public function testCanGetUnitSelector(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->unitSelector());
        $this->assertTrue($price->unitSelector());
    }

    public function testCanGetBunchSelector(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->bunchSelector());
        $this->assertTrue($price->bunchSelector());
    }

    public function testCanGetDrainedWeight(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->drainedWeight());
        $this->assertSame(1.2, $price->drainedWeight());
    }

    public function testCanGetSellingMethod(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsInt($price->sellingMethod());
        $this->assertSame(1, $price->sellingMethod());
    }

    public function testCanGetPriceDecreased(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsBool($price->priceDecreased());
        $this->assertFalse($price->priceDecreased());
    }

    public function testCanGetReferencePrice(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->referencePrice());
        $this->assertSame(10.0, $price->referencePrice());
    }

    public function testCanGetMinBunchAmount(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->minBunchAmount());
        $this->assertSame(1.0, $price->minBunchAmount());
    }

    public function testCanGetReferenceFormat(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsString($price->referenceFormat());
        $this->assertSame("kg", $price->referenceFormat());
    }

    public function testCanGetIncrementBunchAmount(): void
    {
        $price = PriceExample::dummy();
        $this->assertIsFloat($price->incrementBunchAmount());
        $this->assertSame(1.0, $price->incrementBunchAmount());
    }
}