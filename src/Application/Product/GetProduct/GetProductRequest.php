<?php declare(strict_types=1);

namespace Mercadona\Application\Product\GetProduct;

use Mercadona\Shared\Application\Request;

final class GetProductRequest implements Request
{
    public function __construct(
        public readonly int $productId
    ) {
    }
}