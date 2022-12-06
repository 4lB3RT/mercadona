<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductRepository;

final class EloquentProductRepository implements ProductRepository
{
    public function find(ProductId $productId): Product
    {
        return ProductDataTransformer::fromModel(ProductEloquent::with("categories", "prices")->find($productId->value));
    }

    public function findAll(): ProductCollection
    {
        $productEloquent = new ProductEloquent();

        $productCollectionEloquent = $productEloquent->with("categories")->get();

        return ProductDataTransformer::fromCollection($productCollectionEloquent);
    }

    public function save(Product $product): void
    {
        $productEloquent = new ProductEloquent();
        $productArray = ProductDataTransformer::fromEntity($product);
        $productEloquentSaved = $productEloquent->updateOrCreate(
            ['id' => $product->id->value],
            $productArray
        );

        $productEloquentSaved->categories()->sync(implode(",", $product->categories()->ids()));
        $productEloquentSaved->prices()->sync(implode(",", $product->prices()->ids()));
    }
}