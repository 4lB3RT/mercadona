<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

use Mercadona\Product\Domain\Product;
use Mercadona\Shared\Domain\Collection;

final class ProductCollection extends Collection
{
    public function type(): string
    {
        return Product::class;
    }
}
