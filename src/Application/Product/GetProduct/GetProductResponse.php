<?php declare(strict_types=1);

namespace Mercadona\Application\Product\GetProduct;

use Mercadona\Domain\Product\Product;
use Mercadona\Shared\Application\Response;

final class GetProductResponse implements Response
{
    public function __construct(
        public readonly Product $product
    ) {
    }
}