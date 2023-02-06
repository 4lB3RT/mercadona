<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategory;

use Mercadona\Shared\Application\Request;

final class GetCategoryRequest implements Request
{
    public function __construct(
        private readonly int $categoryId
    ) {
    }

    public function categoryId(): int
    {
        return $this->categoryId;
    }
}