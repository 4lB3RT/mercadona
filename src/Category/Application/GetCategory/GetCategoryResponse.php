<?php declare(strict_types=1);

namespace Mercadona\Category\Application\GetCategory;

use Mercadona\Category\Domain\Category;
use Mercadona\Shared\Application\Response;

final class GetCategoryResponse implements Response
{
    public function __construct(
        private readonly Category $category
    ) {
    }

    public function category(): Category
    {
        return $this->category;
    }
}