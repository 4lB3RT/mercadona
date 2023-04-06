<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

final class ProductRemoteId
{
    public function __construct(
        private readonly int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
