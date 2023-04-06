<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

use Mercadona\Shared\Domain\Collection;

final class CategoryCollection extends Collection
{
    public function type(): string
    {
        return Category::class;
    }

    public function ids(): array
    {
        $itemsIds = [];
        foreach ($this->items() as $category) {
            if ($category->categories()->isEmpty() === false) {
                $itemsIds = $category->categories()->ids();
            }
            $itemsIds[] = (int) $category->id->value;
        }

        return $itemsIds;
    }
}
