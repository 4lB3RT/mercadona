<?php declare(strict_types=1);

namespace Tests\Mercadona\Application\Category\GetCategory\GetCategory;

use Mercadona\Application\Category\GetCategory\GetCategoryRequest;
use Tests\Mercadona\Shared\Domain\IntegerExample;

final class GetCategoryRequestExample {

    public static function create(
        int $categoryId = null
    ): GetCategoryRequest
    {
        return new GetCategoryRequest(
            $categoryId ?? IntegerExample::random()
        );
    }
}