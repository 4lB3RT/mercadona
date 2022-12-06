<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Presenters\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Infrastructure\Domain\Category\CategoryDataTransformer;
use Mercadona\Infrastructure\Domain\Price\PriceDataTransformer;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

final class GetProductPresenter implements JsonPresenter
{ 
    public function toJson(Response $response): string
    {
        /** @var Product $product */
        $product = $response->product;

        $products = PriceDataTransformer::fromEntities($product->prices());
        
        return json_encode([
            "product" => [
                "id" => $product->id->value,
                "name" => $product->name->value,
                "ean" => $product->ean,
                "slug" => $product->slug,
                "brand" => $product->brand,
                "limit" => $product->limit,
                "origin" => $product->origin,
                "packaging" => $product->packaging,
                "published" => $product->published,
                "shareUrl" => $product->shareUrl,
                "thumbnail" => $product->thumbnail,
                "isVariableWeight" => $product->isVariableWeight,
                "categories" => CategoryDataTransformer::fromEntities($product->categories()),
                "prices" => PriceDataTransformer::fromEntities($product->prices()),
            ]
        ]);
    }
}