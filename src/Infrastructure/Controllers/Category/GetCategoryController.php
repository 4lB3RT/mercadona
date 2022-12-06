<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mercadona\Application\Category\GetCategory\GetCategoryRequest;
use Mercadona\Application\Category\GetCategory\GetCategory;
use Mercadona\Infrastructure\Presenters\Category\GetCategoryPresenter;
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