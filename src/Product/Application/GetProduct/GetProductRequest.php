<?php declare(strict_types=1);

namespace Mercadona\Product\Application\GetProduct;

use Mercadona\Shared\Application\Request;

final class GetProductRequest implements Request
{
    public function __construct(
        private readonly int $productId
    ) {
    }

    public function productId(): int
    {
        return $this->productId;
    }
}