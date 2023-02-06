<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Mercadona\Application\Product\GetProduct\GetProduct;
use Mercadona\Application\Product\GetProduct\GetProductRequest;
use Mercadona\Infrastructure\Presenters\Product\GetProductPresenter;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class GetProductController extends Controller
{ 
    public function __invoke(
        int $productId,
        GetProduct $getProduct,
        GetProductPresenter $getProductPresenter
    ): JsonResponse {
        try {
            $request = new GetProductRequest($productId);
            $response = $getProduct->execute($request);

            return new JsonResponse(
                data: $getProductPresenter->toJson($response),
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