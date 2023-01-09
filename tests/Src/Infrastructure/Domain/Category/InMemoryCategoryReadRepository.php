<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

final class InMemoryCategoryReadRepository implements CategoryReadRepository
{
    private array $categories = [];

    public function findParentCategories(): CategoryCollection
    {
        $parentCategories = array_filter($this->categories, function (Category $category) {
            return $category->hasParent();
        });

        return new CategoryCollection(...$parentCategories);
    }

    public function findDetailCategory(Category $category, ?Category $parent = null): Category
    {
        if ($parent === null) {
            /** @var Category $parent */
            $parent = $this->findParentCategories()->find($category->id());
        }

        if ($parent === null) {
            throw new CategoryNotFoundException($category->id());
        }

        $categories = $parent->categories();
        $categories->addChild($category);
        $parent->updateCategories($category);

        return $parent;
    }
}
