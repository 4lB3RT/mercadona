<?php declare(strict_types=1);

namespace Mercadona\Domain\Product\Service;

use Mercadona\Domain\Product\Product;

interface SaveProduct {
    public function save(Product $product): Product;
}