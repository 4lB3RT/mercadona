<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

interface ProductRepository 
{
    public function find(ProductId $productId): Product;

    public function findAll(): ProductCollection; 

    public function save(Product $product): Product;
}