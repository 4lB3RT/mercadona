<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Product\ProductRepository;

final class EloquentProductRepository implements ProductRepository
{
    public function save(Product $product): void
    {
        $productEloquent = new ProductEloquent();
        $productEloquentSaved = $productEloquent->updateOrCreate(
            ['id' => $product->id->value],
            ProductDataTransformer::fromEntity($product)
        );

        $productEloquentSaved->categories()->sync(implode(",", $product->categories()->ids()));
    }

    public function saveAll(ProductCollection $products): void
    {
        /** @var Product $product */
        foreach ($products->items() as $product) {
            $this->save($product);
        }
    }

}