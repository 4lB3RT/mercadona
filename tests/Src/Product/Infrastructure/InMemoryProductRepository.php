<?php declare(strict_types=1);

namespace Tests\Mercadona\Product\Infrastructure;

use Mercadona\Product\Domain\Product;
use Mercadona\Product\Domain\ValueObject\ProductId;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Product\Domain\ProductNotFoundException;
use Mercadona\Product\Domain\ProductRepository;

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
