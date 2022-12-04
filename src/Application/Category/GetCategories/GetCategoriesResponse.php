<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategories;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Shared\Application\Response;

final class GetCategoriesResponse implements Response
{
    public function __construct(
        public readonly CategoryCollection $categories
    ) {
    }
}