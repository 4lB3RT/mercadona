<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategory;

use Mercadona\Domain\Category\Category;
use Mercadona\Shared\Application\Response;

final class GetCategoryResponse implements Response
{
    public function __construct(
        public readonly Category $category
    ) {
    }
}