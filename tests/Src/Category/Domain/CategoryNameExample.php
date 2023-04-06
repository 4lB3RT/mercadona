<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain;

use Mercadona\Category\Domain\CategoryName;
use Tests\Mercadona\Shared\Domain\StringExample;

final class CategoryNameExample {

    public static function random(): CategoryName
    {
        return new CategoryName(StringExample::random());
    }
}