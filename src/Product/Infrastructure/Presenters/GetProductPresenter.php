<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Presenters;

use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;
use Mercadona\Price\Infrastructure\Transformers\PriceDataTransformer;
use Mercadona\Product\Application\GetProduct\GetProductResponse;
use Mercadona\Product\Domain\Product;

final class GetProductPresenter implements JsonPresenter
{ 
    /** @param GetProductResponse $response */
    public function toJson(Response $response): string
    {
        /** @var Product $product */
        $product = $response->product();
        
        return json_encode([
            "product" => [
                "id" => $product->id()->value(),
                "name" => $product->name()->value(),
                "ean" => $product->ean(),
                "slug" => $product->slug(),
                "brand" => $product->brand(),
                "limit" => $product->limit(),
                "origin" => $product->origin(),
                "packaging" => $product->packaging(),
                "published" => $product->published(),
                "shareUrl" => $product->shareUrl(),
                "thumbnail" => $product->thumbnail(),
                "isVariableWeight" => $product->isVariableWeight(),
                "categories" => $product->categoryIds()->ids(),
                "prices" => PriceDataTransformer::fromEntities($product->prices()),
            ]
        ]);
    }
}