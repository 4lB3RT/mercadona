<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\FinderCategoryRepository;

final class ApiFinderCategoryRepository implements FinderCategoryRepository
{
    public function findCategories(): CategoryCollection
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

        return CategoryDataTransformer::fromArrays($response["results"], null);
    }
}
