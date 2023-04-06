<?php declare(strict_types=1);

namespace Tests\Mercadona\Product\Domain;

use Mercadona\Product\Domain\Product;
use Mercadona\Product\Domain\ProductId;
use Mercadona\Product\Domain\ProductName;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Price\Domain\PriceCollection;
use Tests\Mercadona\Domain\Photo\PhotoExample;
use Tests\Mercadona\Domain\Price\PriceExample;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\StringExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;
use Mercadona\Category\Domain\CategoryIdCollection;
use Tests\Mercadona\Product\Domain\ProductIdExample;
use Tests\Mercadona\Domain\Category\CategoryIdExample;
use Tests\Mercadona\Product\Domain\ProductNameExample;

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
            ProductNameExampleTests\Mercadona\Price\Domain\IvaExample::random(),
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