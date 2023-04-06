<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Repositories\Eloquent;

use Mercadona\Photo\Domain\PhotoRepository;
use Mercadona\Price\Domain\PriceRepository;
use Mercadona\Product\Domain\Product;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Product\Domain\ProductId;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Product\Infrastructure\Models\ProductEloquent;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;

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