<?php declare(strict_types=1);

namespace Tests\Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductNotFoundException;
use Mercadona\Domain\Product\ProductRepository;

final class InMemoryProductRepository implements ProductRepository
{
    private array $products = [];

    public function find(ProductId $productId): Product
    {
        if (!array_key_exists((string) $productId->value(), $this->products)) {
            throw new ProductNotFoundException($productId);
        }

        return $this->products[(string) $productId->value()];
    }

    public function findAll(): ProductCollection
    {
        return new ProductCollection(...$this->products);
    }

    public function save(Product $product): void
    {
        $this->products[(string) $product->id()] = $product;
    }
}
