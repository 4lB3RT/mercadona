<?php declare(strict_types=1);

namespace Tests\Mercadona\Price\Domain;

use Mercadona\Price\Domain\Iva;
use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceId;
use Tests\Mercadona\Price\Domain\IvaExample;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\FloatExample;
use Tests\Mercadona\Price\Domain\PriceIdExample;
use Tests\Mercadona\Shared\Domain\StringExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class PriceExample {

    public static function dummy(): Price
    {
        return new Price(
            id: new PriceId(1),
            iva: Iva::SUPERREDUCIDO,
            isNew: true,
            isPack: false,
            packSize: 1.2,
            unitName: 1,
            unitSize: 1.0,
            bulkPrice: 10.0,
            unitPrice: 10.0,
            approxSize: true,
            sizeFormat: "kg",
            totalUnits: null,
            unitSelector: true,
            bunchSelector: true,
            drainedWeight: 1.2,
            sellingMethod: 1,
            priceDecreased: false,
            referencePrice: 10.0,
            minBunchAmount: 1.0,
            referenceFormat: "kg",
            incrementBunchAmount: 1.0
        );
    }

    public static function random(): Price
    {
        return new Price(
            id: PriceIdExample::random(),
            iva: IvaExample::random(),
            isNew: BoolExample::random(),
            isPack: BoolExample::random(),
            packSize: FloatExample::random(),
            unitName: IntegerExample::random(),
            unitSize: FloatExample::random(),
            bulkPrice: FloatExample::random(),
            unitPrice: FloatExample::random(),
            approxSize: BoolExample::random(),
            sizeFormat: StringExample::random(),
            totalUnits: IntegerExample::random(),
            unitSelector: BoolExample::random(),
            bunchSelector: BoolExample::random(),
            drainedWeight: FloatExample::random(),
            sellingMethod: IntegerExample::random(),
            priceDecreased: BoolExample::random(),
            referencePrice: FloatExample::random(),
            minBunchAmount: FloatExample::random(),
            referenceFormat: StringExample::random(),
            incrementBunchAmount: FloatExample::random()
        );
    }
}