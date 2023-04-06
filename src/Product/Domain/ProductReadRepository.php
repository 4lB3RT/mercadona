<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

interface ProductReadRepository {
    public function findDetailProduct(ProductId $productId): Product;
}