<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryStatus;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

final class ApiCategoryRepository implements CategoryReadRepository
{
    public function findParentCategories(): CategoryCollection
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

    public function findDetailCategory(Category $category): Category
    {
      
      try{
        $client = new Client([ 'base_uri' => 'https://tienda.mercadona.es/api/']);
        $response = $client->request('GET', 'categories/'.$category->id()->value());
        
        $response = (array) json_decode($response->getBody()->getContents(), true);
        
        $categories = CategoryDataTransformer::fromArrays(
          $response["categories"],
          CategoryDataTransformer::fromEntity($category)
        );
        
        $category->modifyCategories($categories);    
        
        $category->modifyStatus(CategoryStatus::PROCESSED);
      } catch(GuzzleException $exception) {
        $code = $exception->getCode();

        if ($code === HttpFoundationResponse::HTTP_GONE) {
          $category->modifyStatus(CategoryStatus::PROCESSED);
        }

        if ($code === HttpFoundationResponse::HTTP_TOO_MANY_REQUESTS) {
          $category->modifyStatus(CategoryStatus::FAIL);        }
      }

      return $category;
    }
}
