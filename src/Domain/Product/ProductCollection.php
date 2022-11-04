<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Product\Product;

final class ProductCollection
{
    public function __construct(
        private readonly ?array $itmes
    ) {}

    public function type(): string
    {
        return Product::class;
    }

    public static function empty(): self
    {
        return new self(null);
    }
}
