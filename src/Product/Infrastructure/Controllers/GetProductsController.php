<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mercadona\Product\Application\GetProducts\GetProducts;
use Mercadona\Product\Infrastructure\Presenters\GetProductsPresenter;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetProductsController extends Controller
{ 
    public function __invoke(
        GetProducts $getProducts,
        GetProductsPresenter $presenter
    ): JsonResponse {
        try {
            $response = $getProducts->execute();

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
                $exception->getLine(),
                $exception->__toString()
            ],
              status: Response::HTTP_BAD_REQUEST, 
            );
        }
    }
}