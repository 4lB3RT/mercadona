<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

interface ProductRepository {
    public function save(Product $product): void;

    public function saveAll(ProductCollection $products): void;
}