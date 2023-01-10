<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Category\CategoryCollection;

final class CategoryCollectionExample {

    public static function dummy(): CategoryCollection
    {
        return new CategoryCollection([CategoryExample::dummy()]);
    }

    public static function random(): CategoryCollection
    {
        return new CategoryCollection([CategoryExample::random()]);
    }

    public static function empty(): CategoryCollection
    {
        return new CategoryCollection([]);
    }

}