<?php declare(strict_types=1);

namespace Tests\Mercadona\Shared\Domain;

final class IntegerExample {

    public static function random(): int
    {
        return random_int(10, 9999);
    }
}