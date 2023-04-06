<?php declare(strict_types=1);

namespace Tests\Mercadona\Price\Domain;

use Mercadona\Price\Domain\Iva;

final class IvaExample {

    public static function dummy(): Iva
    {
        return Iva::GENERAL;
    }

    public static function create(
        ?Iva $iva = null
    ): Iva {
        return $iva ?? self::random();
    }

    public static function random(): Iva
    {
        return Iva::cases()[array_rand(Iva::cases())];
    }
}