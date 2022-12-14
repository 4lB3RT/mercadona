<?php declare(strict_types=1);

namespace Mercadona\Application\Product\GetProducts;

use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Domain\Product\Service\SaveProduct;

final class GetProducts
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly SaveProduct $saveProduct
    ) {}

    public function execute(): GetProductsResponse
    {        
        $products = $this->productRepository->findAll();
                
        return new GetProductsResponse($products);
    }
}
