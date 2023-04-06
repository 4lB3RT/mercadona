<?php declare(strict_types=1);

namespace Mercadona\Product\Application\GetProduct;

use Mercadona\Product\Domain\Product;
use Mercadona\Shared\Application\Response;

final class GetProductResponse implements Response
{
    public function __construct(
        private readonly Product $product
    ) {
    }

    public function product(): Product
    {
        return $this->product;
    }
}