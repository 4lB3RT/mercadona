<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Mercadona\Category\Application\GetCategory\GetCategory;
use Mercadona\Category\Application\GetCategory\GetCategoryRequest;
use Mercadona\Category\Infrastructure\Presenters\GetCategoryPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetCategoryController extends Controller
{ 
    public function __invoke(
        GetCategory $getCategory,
        int $categoryId,
        GetCategoryPresenter $presenter
    ): JsonResponse {
        try {
            $request = new GetCategoryRequest($categoryId);
            
            $response = $getCategory->execute($request);

            return new JsonResponse(
                data: $presenter->toJson($response),
                status: Response::HTTP_OK,
                json: true
            );
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage()); 

            return new JsonResponse(data:
            [
                $exception->getMessage(), 
                $exception->getFile(), 
                $exception->getLine()
            ],
              status: Response::HTTP_BAD_REQUEST, 
            );
        }
    }
}