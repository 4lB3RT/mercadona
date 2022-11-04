<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

interface FinderProductRepository {
    public function findProduct(): Product;
}