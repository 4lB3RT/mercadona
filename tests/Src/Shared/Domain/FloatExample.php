<?php declare(strict_types=1);

namespace Tests\Mercadona\Shared\Domain;

final class FloatExample {

    public static function random(): float
    {
        return rand(1000,2000)/100;
    }
}