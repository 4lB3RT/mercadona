<?php declare(strict_types=1);

namespace Mercadona\Domain\Price;

final class PriceId
{
    public function __construct(
        public readonly int $value
    ) {
    }
}
