<?php declare(strict_types=1);

namespace Mercadona\Product\Application\GetProducts;

use Mercadona\Product\Domain\ProductRepository;

final class GetProducts
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {}

    public function execute(): GetProductsResponse
    {        
        $products = $this->productRepository->findAll();
                
        return new GetProductsResponse($products);
    }
}
