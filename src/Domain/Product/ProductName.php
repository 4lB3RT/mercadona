<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

final class ProductName
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
