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
                "category_id" => $product->categoryId()->value(),
                "name" => $product->name()->value(),
                "ean" => $product->ean()->value(),
                "slug" => $product->slug()->value(),
                "brand" => $product->brand()->value(),
                "limit" => $product->limit()->value(),
                "origin" => $product->origin()->value(),
                "packaging" => $product->packaging()->value(),
                "published" => $product->published()->value(),
                "shareUrl" => $product->shareUrl()->value(),
                "thumbnail" => $product->thumbnail()->value(),
                "isVariableWeight" => $product->isVariableWeight()->value(),
                "prices" => PriceDataTransformer::fromEntities($product->prices()),
            ]
        ]);
    }
}