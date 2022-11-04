<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

final class ProductName
{
    public function __construct(
        private readonly string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
