<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Product;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Tests\Mercadona\Domain\Category\CategoryCollectionExample;
use Tests\Mercadona\Domain\Category\ProductIdExample;
use Tests\Mercadona\Domain\Category\ProductNameExample;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;
use Tests\Mercadona\Shared\Domain\StringExample;

final class ProductExmaple {

    public static function dummy(): Product
    {
        return new Product(
            new ProductId(1),
            CategoryCollectionExample::dummy(),
            new ProductName("Dummy"),
            "dummy-slug",
            999,
            true,
            "https://dummyproduct.com",
            "https://dummyproduct.com/images/file.jpg?fit=crop&h=300&w=300",
        );
    }

    public static function random(): Product
    {
        return new Product(
            ProductIdExample::random(),
            CategoryCollectionExample::random(),
            ProductNameExample::random(),
            StringExample::random(),
            IntegerExample::random(),
            BoolExample::random(),
            StringExample::random(),
            StringExample::random(),
        );
    }
}