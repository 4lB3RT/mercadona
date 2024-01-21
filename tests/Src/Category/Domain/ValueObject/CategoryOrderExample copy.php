<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain\ValueObject;

use Mercadona\Category\Domain\ValueObject\CategoryPublished;
use Tests\Mercadona\Shared\Domain\BoolExample;

final class CategoryPublishedExample {

    public static function dummy(): CategoryPublished
    {
        return new CategoryPublished(true);
    }

    public static function create(
        ?CategoryPublished $categoryOrder = null
    ): CategoryPublished {
        return $categoryOrder ?? self::random();
    }

    public static function random(): CategoryPublished
    {
        return new CategoryPublished(BoolExample::random());
    }
}