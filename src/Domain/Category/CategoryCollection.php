<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

use Mercadona\Shared\Domain\Collection;

final class CategoryCollection extends Collection
{
    public function type(): string
    {
        return Category::class;
    }

    public function isEmpty(): bool
    {
        return $this->items !== null ? false : true;
    }
}
