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
        return ProductDataTransformer::fromModel(ProductEloquent::with("categories", "prices", "photos")->findOrFail($productId->value));
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
            ['id' => $product->id()->value()],
            $productArray
        );

        $productModel = $productEloquentSaved->findOrFail($product->id()->value());
        $productModel->categories()->sync($product->categoryIds()->ids());
        $productModel->prices()->attach($product->prices()->ids());
        if (!$product->photos()->isEmpty()) {
            $productModel->photos()->attach($product->photos()->ids());
        }
    }
}