<?php declare(strict_types=1);

namespace Mercadona\Category\Application\GetCategories;

use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Shared\Application\Response;

final class GetCategoriesResponse implements Response
{
    public function __construct(
        private readonly CategoryCollection $categories
    ) {
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }
}