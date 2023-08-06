<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

use Mercadona\Product\Domain\ValueObject\ProductId;

interface ProductRepository 
{
    public function find(ProductId $productId): Product;

    public function findAll(): ProductCollection; 

    public function save(Product $product): void;
}