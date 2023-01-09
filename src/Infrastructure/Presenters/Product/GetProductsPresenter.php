<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Presenters\Product;

use Mercadona\Application\Product\GetProducts\GetProductsResponse;
use Mercadona\Infrastructure\Domain\Product\ProductDataTransformer;
use Mercadona\Shared\Application\Response;
use Mercadona\Shared\Infrastructure\Presenters\JsonPresenter;

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