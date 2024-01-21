<?php declare(strict_types=1);

namespace Mercadona\Product\Application\GetProduct;

use Mercadona\Product\Domain\ValueObject\ProductId;
use Mercadona\Shared\Application\Request;
use Mercadona\Product\Application\GetProduct\GetProductResponse;
use Mercadona\Product\Domain\ProductReadRepository;
use Mercadona\Product\Domain\ProductRepository;

final class GetProduct
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    /** @var GetProductRequest $request */
    public function execute(Request $request): GetProductResponse
    {
        $productId = new ProductId($request->productId());

        $product = $this->productRepository->find($productId);
                        
        return new GetProductResponse($product);
    }
}
