<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryRepository;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function save(Category $category): void
    {
        $categoryEloquent = new CategoryEloquent();

        $categoryEloquent->fill(CategoryDataTransformer::fromEntity($category));

        $categoryEloquent->save();
    }

    public function saveAll(CategoryCollection $categories): void
    {
        /** @var Category $category */
        foreach ($categories->items() as $category) {
            $this->save($category);

            if ($category->hasCategories()) {
                $this->saveAll($category->categories());
            }
        }
    }
}
