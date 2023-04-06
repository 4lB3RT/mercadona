<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Mercadona\Category\Application\GetCategories\GetCategories;
use Mercadona\Category\Infrastructure\Presenters\GetCategoriesPresenter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

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
                json: true
            );
        } catch (\Throwable $exception) {
            \Log::info($exception->getMessage()); 

            return new JsonResponse(data:
            [
                $exception->getMessage(), 
                $exception->getFile(), 
                $exception->getLine(),
                $exception->__toString()
            ],
              status: Response::HTTP_BAD_REQUEST, 
            );
        }
    }
}