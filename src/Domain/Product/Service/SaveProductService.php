<?php declare(strict_types=1);

namespace Mercadona\Domain\Product\Service;

use Mercadona\Domain\Photo\PhotoRepository;
use Mercadona\Domain\Price\PriceRepository;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductRepository;

final class SaveProductService implements SaveProduct
{
    public function __construct(
        private readonly ProductRepository $productRepository,
        private readonly PriceRepository $priceRepository,  
        private readonly PhotoRepository $photoRepository  
    ) {}

    public function save(Product $product): Product
    {       
        $pricesSaved = $this->priceRepository->saveAll($product->prices());

        if ($product->photos()->isEmpty() === false) {
            $photosSave = $this->photoRepository->saveAll($product->photos());
            $product->modifyPhotos($photosSave);
        }

        $product->modifyPrices($pricesSaved);
        $this->productRepository->save($product);

        return $product;
    }
}