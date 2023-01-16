<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Product;

use Mercadona\Domain\Category\CategoryIdCollection;
use Mercadona\Domain\Photo\PhotoCollection;
use Mercadona\Domain\Price\PriceCollection;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Tests\Mercadona\Domain\Category\CategoryIdExample;
use Tests\Mercadona\Domain\Photo\PhotoExample;
use Tests\Mercadona\Domain\Price\PriceExample;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;
use Tests\Mercadona\Shared\Domain\StringExample;

final class ProductExample {

    public static function dummy(): Product
    {
        return new Product(
            new ProductId(1),
            new ProductName("Dummy Product"),
            null,
            null,
            "Dummy Brand",
            10,
            "Dummy Origin",
            "Dummy Packaging",
            true,
            "dummy-product",
            "dummy-thumbnail.jpg",
            null,
            new CategoryIdCollection([
                CategoryIdExample::dummy(),
            ]),
            new PriceCollection([
                PriceExample::dummy(),
            ]),
            new PhotoCollection([
                PhotoExample::dummy()
            ])
        );
    }

    public static function random(): Product
    {
        return new Product(
            ProductIdExample::random(),
            ProductNameExample::random(),
            IntegerExample::random(),
            StringExample::random(),
            StringExample::random(),
            IntegerExample::random(),
            StringExample::random(),
            StringExample::random(),
            BoolExample::random(),
            StringExample::random(),
            StringExample::random(),
            StringExample::random(),
            CategoryIdCollection::empty(),
            PriceCollection::empty(),
            PhotoCollection::empty()
        );
    }
}