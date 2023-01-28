<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use GuzzleHttp\Client;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductReadRepository;

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
