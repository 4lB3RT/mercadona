<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

use Mercadona\Shared\Domain\Collection;

final class CategoryCollection extends Collection
{
    public function children(): self
    {
        $categoriesWithChildren = [];

        /** @var Category $category */
        foreach ($this->items as $category) {
            /** @var Category $category */
            foreach ($category->categories()->items() as $category) {
                $categoriesWithChildren[] = $category;    
            }
        }

        return new self($categoriesWithChildren);
    }

    public function type(): string
    {
        return Category::class;
    }

    public function isEmpty(): bool
    {
        return $this->items !== null ? false : true;
    }

    public static function empty(): self
    {
        return new self([]);
    }

}
