<?php declare(strict_types=1);

namespace Mercadona\Domain\Product\Service;

use Mercadona\Domain\Price\Price;
use Mercadona\Domain\Price\PriceRepository;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductRepository;

final class SaveProductService implements SaveProduct
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly PriceRepository $priceRepository,  
    ) {}

    public function save(Product $product): Product
    {       
        $pricesSaved = $this->priceRepository->saveAll($product->prices());

        $product->modifyPrices($pricesSaved);
        $this->productRepository->save($product);

        return $product;
    }
}