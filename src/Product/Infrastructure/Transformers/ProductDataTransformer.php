<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Transformers;

use Mercadona\Product\Domain\Product;
use Illuminate\Database\Eloquent\Model;
use Mercadona\Category\Domain\Category;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Price\Domain\PriceCollection;
use Illuminate\Database\Eloquent\Collection;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Product\Domain\ValueObject\ProductId;
use Mercadona\Product\Domain\ValueObject\ProductEan;
use Mercadona\Category\Domain\ValueObject\CategoryId;
use Mercadona\Product\Domain\ValueObject\ProductName;
use Mercadona\Product\Domain\ValueObject\ProductSlug;
use Mercadona\Product\Domain\ValueObject\ProductBrand;
use Mercadona\Product\Domain\ValueObject\ProductLimit;
use Mercadona\Product\Domain\ValueObject\ProductOrigin;
use Mercadona\Product\Domain\ValueObject\ProductWeight;
use Mercadona\Product\Domain\ValueObject\ProductShareUrl;
use Mercadona\Product\Domain\ValueObject\ProductPackaging;
use Mercadona\Product\Domain\ValueObject\ProductPublished;
use Mercadona\Product\Domain\ValueObject\ProductThumbnail;
use Mercadona\Photo\Infrastructure\Transformers\PhotoDataTransformer;
use Mercadona\Price\Infrastructure\Transformers\PriceDataTransformer;

final class ProductDataTransformer
{
    public static function fromArray(array $result, Category $category): Product
    {
        return new Product(
            new ProductId((int) $result["id"]),
            new ProductName($result["display_name"]),
            $category->id(),
            isset($result["photos"])
            ? PhotoDataTransformer::fromArrays($result["photos"])
            : PhotoCollection::empty(),
            isset($result["ean"]) ? new ProductEan((int) $result["ean"]) : new ProductEan(0),
            isset($result["slug"]) ? new ProductSlug($result["slug"]) : new ProductSlug(""),
            isset($result["brand"]) ? new ProductBrand($result["brand"]) : new ProductBrand(""),
            new ProductLimit($result["limit"]),
            isset($result["origin"]) ? new ProductOrigin($result["origin"]) : new ProductOrigin(""),
            isset($result["packaging"]) ? new ProductPackaging($result["packaging"]) : new ProductPackaging(""),
            isset($result["published"]) ? new ProductPublished((bool) $result["published"]) : new ProductPublished(false),
            isset($result["share_url"]) ? new ProductShareUrl($result["share_url"]) : new ProductShareUrl(""),
            new ProductThumbnail($result["thumbnail"]),
            isset($result["isVariableWeight"])
                ? new ProductWeight($result["isVariableWeight"])
                : new ProductWeight(0),
            isset($result["price_instructions"])
                ? PriceDataTransformer::fromArrays($result["price_instructions"], (int) $result["id"])
                : PriceCollection::empty()
        );
    }

    public static function fromArrays(array $productsArray, Category $category): ProductCollection
    {
        $products = [];
        foreach ($productsArray as $productArray) {
            $products[] = self::fromArray($productArray, $category);
        }

        return new ProductCollection($products);
    }

    public static function fromEntity(Product $product): array
    {
       return [
            "id" => $product->id()->value(),
            "category_id" => $product->categoryId()->value(),
            "name" => $product->name()->value(),
            "ean" => $product->ean()->value(),
            "slug" => $product->slug()->value(),
            "brand" => $product->brand()->value(),
            "limit" => $product->limit()->value(),
            "origin" => $product->origin()->value(),
            "packaging" => $product->packaging()->value(),
            "published" => $product->published()->value(),
            "share_url" => $product->shareUrl()->value(),
            "thumbnail" => $product->thumbnail()->value(),
            "is_variable_weight" => $product->isVariableWeight()->value(),
        ];
    }

    public static function fromEntities(ProductCollection $products)
    {
        $productsArray = [];

        /** @var Product $product */
        foreach ($products as $product) {
            $productsArray[] = self::fromEntity($product);
        }

        return $productsArray;
    }

    public static function fromCollection(Collection $collection): ProductCollection
    {
        $products = [];
        /** @var Model $model */
        foreach ($collection as $model) {
            $products[] = self::fromModel($model);
        }

        return new ProductCollection($products);
    }

    public static function fromModel(Model $model): Product
    {
        $photos = PhotoCollection::empty();
        if ($model->relationLoaded('photos')) {
            $photos = PhotoDataTransformer::fromCollection($model->photos);

        }
        return new Product(
            new ProductId($model->id),
            new ProductName($model->name),
            new CategoryId($model->category_id),
            $photos,
            new ProductEan($model->ean),
            new ProductSlug($model->slug),
            new ProductBrand($model->brand),
            new ProductLimit($model->limit),
            new ProductOrigin($model->origin),
            new ProductPackaging($model->packaging),
            new ProductPublished((bool)$model->published),
            new ProductShareUrl($model->share_url),
            new ProductThumbnail($model->thumbnail),
            $model->isVariableWeight ? new ProductWeight($model->isVariableWeight) : new ProductWeight(0),
            ($model->prices !== null) ? PriceDataTransformer::fromCollection($model->prices) : PriceCollection::empty(),
        );
    }

}
