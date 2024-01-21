<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Mercadona\Photo\Domain\PhotoRepository;
use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceRepository;
use Mercadona\Product\Domain\Product;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Product\Domain\ValueObject\ProductId;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Product\Infrastructure\Models\ProductEloquent;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;
use Throwable;

final class EloquentProductRepository implements ProductRepository
{
    public function __construct(
        private readonly PriceRepository $priceRepository,
        private readonly PhotoRepository $photoRepository
    ) {}

    public function find(ProductId $productId): Product
    {
        return ProductDataTransformer::fromModel(ProductEloquent::with("categories", "prices", "photos")->findOrFail($productId->value()));
    }

    public function findAll(): ProductCollection
    {
        $productEloquent = new ProductEloquent();

        $productCollectionEloquent = $productEloquent->with("categories")->get();

        return ProductDataTransformer::fromCollection($productCollectionEloquent);
    }

    public function save(Product $product): void
    {
        try{
            DB::beginTransaction();
            
            $productArray = ProductDataTransformer::fromEntity($product);
            $productDao = ProductEloquent::updateOrCreate(
                ['id' => $product->id()?->value()],
                $productArray
            );

            $product->modifyId(new ProductId($productDao->id));
            
            if ($product->prices()->isNotEmpty()) {
                $prices = $product->prices();
                $this->priceRepository->saveAll($prices);

                $productDao->prices()->attach($prices->ids());
            }
            
            if ($product->photos()->isNotEmpty()) {
                $photos = $product->photos();
                $this->photoRepository->saveAll($photos);
                $productDao->photos()->sync($photos->ids());
            }
            
            DB::commit();
        }catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }
}