<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mercadona\Application\Category\GetCategories\GetCategories;
use Mercadona\Infrastructure\Presenters\Category\GetCategoriesPresenter;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetCategoriesController extends Controller
{ 
    public function __invoke(
        GetCategories $getCategories,
        GetCategoriesPresenter $presenter
    ): JsonResponse {
        try {
            $response = $getCategories->execute();

            return new JsonResponse(
                data: $presenter->toJson($response),
                status: Response::HTTP_OK,
            );
        } catch (\Throwable $exception) {
            Log::info($exception->getMessage()); 

            return new JsonResponse(data:
            [
                $exception->getMessage()
            ],
              status: Response::HTTP_BAD_REQUEST, 
            );
        }
    }
}