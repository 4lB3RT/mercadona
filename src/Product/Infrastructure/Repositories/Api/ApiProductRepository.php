<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Repositories\Api;

use GuzzleHttp\Client;
use Mercadona\Product\Domain\Product;
use Mercadona\Product\Domain\ProductId;
use Mercadona\Product\Domain\ProductReadRepository;
use Mercadona\Product\Infrastructure\Transformers\ProductDataTransformer;

final class ApiProductRepository implements ProductReadRepository
{
    public function findDetailProduct(ProductId $productId): Product
    {
      $client = new Client([ 'base_uri' => 'https://tienda.mercadona.es/api/']);
      $response = $client->request('GET', 'products/'.$productId->value());
      
      $response = (array) json_decode($response->getBody()->getContents(), true);
            
      $product = ProductDataTransformer::fromArray($response);

      return $product;
    }
}
