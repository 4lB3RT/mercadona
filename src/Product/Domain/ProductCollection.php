<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

use Mercadona\Domain\Product\Product;
use Mercadona\Shared\Domain\Collection;

final class ProductCollection extends Collection
{
    public function type(): string
    {
        return Product::class;
    }
}
