<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryName;
use Mercadona\Domain\Category\CategoryStatus;
use Tests\Mercadona\Domain\Product\ProductCollectionExample;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class CategoryExample {

    public static function dummy(): Category
    {
        return new Category(
            new CategoryId(1),
            new CategoryId(1000),
            new CategoryName("Dummy"),
            CategoryStatus::READY,
            true,
            0,
            CategoryCollectionExample::empty(),
            ProductCollectionExample::empty()
        );
    }

    public static function random(): Category
    {
        return new Category(
            CategoryIdExample::random(),
            CategoryIdExample::random(),
            CategoryNameExample::random(),
            CategoryStatus::READY,
            BoolExample::random(),
            IntegerExample::random(),
            CategoryCollectionExample::empty(),
            ProductCollectionExample::empty()
        );
    }
}