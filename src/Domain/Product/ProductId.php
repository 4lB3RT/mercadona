<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

final class ProductId
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
