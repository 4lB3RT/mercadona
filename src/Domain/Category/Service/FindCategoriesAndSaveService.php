<?php declare(strict_types=1);

namespace Mercadona\Domain\Category\Service;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\CategoryStatus;

final class FindCategoriesAndSaveService implements FindCategoriesAndSave
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository
    ) {}

    public function findAndSave(CategoryCollection $categories): CategoryCollection
    {
        $categoriesProcessed = [];
        $categoriesFailed = [];

        /** @var Category $category */
        foreach ($categories->items() as $category) {
            $category = $this->categoryReadRepository->findDetailCategory($category);

            if ($category->status() === CategoryStatus::PROCESSED) {
            $categoriesProcessed[] = $category;
            }

            if ($category->status() === CategoryStatus::FAIL) {
            $categoriesFailed[] = $category;
            }

            $this->categoryRepository->save($category);

            if ($category->hasCategories()) {
                $this->categoryRepository->saveAll($category->categories());
                $this->findAndSave($category->categories());
            }
        }

        dump("Failed: " . count($categoriesFailed),"Processed: " . count($categoriesProcessed));
        if (!empty($categoriesFailed)) {
            $this->findAndSave(new CategoryCollection($categoriesFailed));
        }

        return new CategoryCollection($categoriesProcessed);
    }
}