<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategory;

use Mercadona\Shared\Application\Request;

final class GetCategoryRequest implements Request
{
    public function __construct(
        public readonly int $categoryId
    ) {
    }
}