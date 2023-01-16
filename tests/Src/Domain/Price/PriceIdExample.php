<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Price;

use Mercadona\Domain\Price\PriceId;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class PriceIdExample {

    public static function dummy(): PriceId
    {
        return new PriceId(1);
    }

    public static function create(
        ?PriceId $priceId = null
    ): PriceId {
        return $priceId ?? self::random();
    }

    public static function random(): PriceId
    {
        return new PriceId(IntegerExample::random());
    }
}