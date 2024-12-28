<?php declare(strict_types=1);

namespace Mercadona\Category\Application\SaveCategoriesFromApi;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;

final readonly class SaveCategoriesFromApi
{
    public function __construct(
        private CategoryReadRepository $categoryReadRepository,
        private FindAndSaveCategory $findAndSaveCategory,
    ) {}

    public function execute(): void
    {
        $categories = $this->categoryReadRepository->findParentCategories();

        $this->saveCategories($categories);
    }

    private function saveCategories(CategoryCollection $categories): void
    {
        /** @var Category $category */
        foreach ($categories as $category) {
            if ($category->categories()->isNotEmpty()) {
                $this->saveCategories($category->categories());
            }

            $this->findAndSaveCategory->findAndSave($category);
        }

    }
}
