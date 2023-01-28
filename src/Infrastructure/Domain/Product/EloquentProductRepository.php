<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Photo\PhotoRepository;
use Mercadona\Domain\Price\PriceCollection;
use Mercadona\Domain\Price\PriceRepository;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductRepository;

final class EloquentProductRepository implements ProductRepository
{
    public function __construct(
        private readonly PriceRepository $priceRepository,
        private readonly PhotoRepository $photoRepository
    ) {}

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

    public function save(Product $product): Product
    {
        $productArray = ProductDataTransformer::fromEntity($product);
        $productEloquentSaved = ProductEloquent::updateOrCreate(
            ['id' => $product->id()->value()],
            $productArray
        );

        if (!$product->prices()->isEmpty()) {
            $prices = $this->priceRepository->saveAll($product->prices());
            $productEloquentSaved->prices()->attach($prices->ids());
        }
        
        if (!$product->photos()->isEmpty()) {
            $photos = $this->photoRepository->saveAll($product->photos());
            $productEloquentSaved->photos()->sync($photos->ids());
        }

        return ProductDataTransformer::fromModel($productEloquentSaved);
    }
}