<?php declare(strict_types=1);

namespace Tests\Mercadona\Shared\Domain;

final class BoolExample {

    public static function random(): bool
    {
        return (bool)random_int(0, 1);
    }
}