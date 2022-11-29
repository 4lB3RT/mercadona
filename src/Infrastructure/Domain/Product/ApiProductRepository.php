<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductReadRepository;
use Mercadona\Domain\Product\ProductRepository;

final class ApiProductRepository implements ProductReadRepository
{
    public function findProduct(): Product
    {        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://tienda.mercadona.es/api/categories/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "cache-control: no-cache"
            ),
          ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $response = \json_decode($response, true);

        return ProductDataTransformer::fromArray($response["results"]);
    }
}
