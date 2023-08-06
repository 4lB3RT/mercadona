<?php declare(strict_types=1);

namespace Mercadona\Category\Application\SaveCategoriesFromApi;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;

final class SaveCategoriesFromApi
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
        private readonly FindAndSaveCategory $findAndSaveCategory,
    ) {}

    public function execute(): void
    {
        $categories = $this->categoryReadRepository->findParentCategories();
        
        foreach ($categories as $category) {
            $this->findAndSaveCategory->findAndSave($category);
        } 
    }
}
