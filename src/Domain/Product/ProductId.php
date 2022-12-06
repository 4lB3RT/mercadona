<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

final class ProductId
{
    public function __construct(
        public readonly string $value
    ) {
    }
}
