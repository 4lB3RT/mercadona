<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Infrastructure;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryId;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryNotFoundException;
use Mercadona\Category\Domain\CategoryRepository;

final class InMemoryCategoryRepository implements CategoryRepository
{
    private array $categories = [];

    public function find(CategoryId $categoryId): Category
    {
        foreach ($this->categories as $category) {
            if ($category->getId()->equals($categoryId)) {
                return $category;
            }
        }

        throw new CategoryNotFoundException($categoryId);
    }

    public function findAll(): CategoryCollection
    {
        return new CategoryCollection(...[$this->categories]);
    }

    public function save(Category $category): void
    {
        $this->categories[] = $category;
    }

    public function saveAll(CategoryCollection $categories): void
    {
        foreach ($categories as $category) {
            $this->save($category);
        }
    }
}
