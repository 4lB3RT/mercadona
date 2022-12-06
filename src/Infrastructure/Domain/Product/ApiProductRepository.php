<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use GuzzleHttp\Client;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductReadRepository;

final class ApiProductRepository implements ProductReadRepository
{
    public function findDetailProduct(Product $product): Product
    {
      $client = new Client([ 'base_uri' => 'https://tienda.mercadona.es/api/']);
      $response = $client->request('GET', 'products/'.$product->id->value);
      
      $response = (array) json_decode($response->getBody()->getContents(), true);
            
      $product = ProductDataTransformer::fromArray($response, $product->categories());

      return $product;
    }
}
