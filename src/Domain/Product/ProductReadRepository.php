<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

interface ProductReadRepository {
    public function findDetailProduct(Product $product): Product;
}