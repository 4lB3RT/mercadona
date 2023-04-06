<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Presenters;

use Mercadona\Product\Application\GetProducts\GetProductsResponse;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;

final class GetProductsPresenter implements JsonPresenter
{ 
    /** @param GetProductsResponse $response */
    public function toJson(Response $response): string
    {
        $products = $response->products();

        $products = ProductDataTransformer::fromEntities($products);
        
        return json_encode([
            "products" => [
                $products
            ]
        ]);
    }
}