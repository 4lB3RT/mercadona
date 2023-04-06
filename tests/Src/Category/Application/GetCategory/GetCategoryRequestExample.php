<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Application\GetCategory;

use Tests\Mercadona\Shared\Domain\IntegerExample;
use Mercadona\Category\Application\GetCategory\GetCategoryRequest;

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