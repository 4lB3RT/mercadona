<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Repositories\Api;

use GuzzleHttp\Client;
use Mercadona\Category\Domain\Category;
use GuzzleHttp\Exception\GuzzleException;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryStatus;
use Symfony\Component\HttpFoundation\Response;
use Mercadona\Category\Infrastructure\Transformers\CategoryDataTransformer;
use Mercadona\Product\Domain\ProductRepository;

final class ApiCategoryRepository implements CategoryReadRepository
{
    public function __construct(private readonly ProductRepository $productRepository) {}

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

    public function findDetailCategory(Category $category, ?Category $parent = null): Category
    {
      try{
        $client = new Client([ 'base_uri' => 'https://tienda.mercadona.es/api/']);
        $response = $client->request('GET', 'categories/'.$category->id()->value());
        
        $response = (array) json_decode($response->getBody()->getContents(), true);

        $categoryArray = CategoryDataTransformer::fromEntity($category);

        $categories = CategoryDataTransformer::fromArrays(
          $response["categories"],
          $categoryArray
        );
            
        $category->modifyCategories($categories);    
        $category->modifyStatus(CategoryStatus::PROCESSED);
      } catch(GuzzleException $exception) {
        $code = $exception->getCode();
        
        if ($code === Response::HTTP_GONE) {
          $categories = array_filter(
            $parent->categories()->items(),
            fn(Category $categoryChildren) => $categoryChildren->id()->value() === $category->id()->value()
          );

          $category = current($categories);
          $category->modifyStatus(CategoryStatus::PROCESSED);
        }

        if ($code === Response::HTTP_TOO_MANY_REQUESTS) {
          $category->modifyStatus(CategoryStatus::FAIL);        
        }
      }

      return $category;
    }
}
