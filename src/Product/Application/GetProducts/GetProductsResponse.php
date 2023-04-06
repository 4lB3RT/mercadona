<?php declare(strict_types=1);

namespace Mercadona\Product\Application\GetProducts;

use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Shared\Application\Response;

final class GetProductsResponse implements Response
{
    public function __construct(
        private readonly ProductCollection $products
    ) {
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }
}