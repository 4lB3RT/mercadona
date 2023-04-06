<?php declare(strict_types=1);

namespace Mercadona\Category\Domain\Service;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;

final class FindAndSaveCategoryService implements FindAndSaveCategory
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
    ) {}

    public function findAndSave(Category $category, ?Category $parent = null): Category
    {        
        $category = $this->categoryReadRepository->findDetailCategory($category, $parent);
            
        if (!$category->categories()->isEmpty()) {
            /** @var Category $categoryChildren */
            foreach ($category->categories()->items() as $categoryChildren) {
                $this->findAndSave($categoryChildren, $category);
            }
        }
        
        $this->categoryRepository->save($category);

        return $category;
    }
}