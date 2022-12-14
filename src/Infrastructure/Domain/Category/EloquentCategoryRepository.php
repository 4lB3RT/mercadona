<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryRepository;

final class EloquentCategoryRepository implements CategoryRepository
{
    public function find(CategoryId $categoryId): Category
    {
        return CategoryDataTransformer::fromModel(CategoryEloquent::with("categories")->findOrFail($categoryId->value));
    }

    public function findAll(): CategoryCollection
    {
        $categoryEloquent = new CategoryEloquent();

        $categoryCollectionEloquent = $categoryEloquent->with("categories", "products")->get();

        return CategoryDataTransformer::fromCollection($categoryCollectionEloquent);
    }

    public function save(Category $category): void
    {
        $categoryArray = CategoryDataTransformer::fromEntity($category);
        CategoryEloquent::updateOrCreate(
            ['id' => $category->id->value],
            $categoryArray
        );
    }

    public function saveAll(CategoryCollection $categories): void
    {
        /** @var Category $category */
        foreach ($categories->items() as $category) {
            $this->save($category);

            if ($category->categories()->isEmpty() === false) {
                $this->saveAll($category->categories());
            }
        }
    }
}
