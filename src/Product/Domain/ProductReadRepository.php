<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

use Mercadona\Product\Domain\ValueObject\ProductId;

interface ProductReadRepository {
    public function findDetailProduct(ProductId $productId): Product;
}