<?php declare(strict_types=1);

namespace Mercadona\Application\Product\GetProduct;


use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductReadRepository;
use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Shared\Application\Request;

final class GetProduct
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly ProductReadRepository $productReadRepository,
    ) {}

    /** @var GetProductRequest $request */
    public function execute(Request $request): GetProductResponse
    {
        $productId = new ProductId($request->productId());
        
        $productWithDetail = $this->productReadRepository->findDetailProduct($productId);
                
        $this->productRepository->save($productWithDetail);

        return new GetProductResponse($productWithDetail);
    }
}
