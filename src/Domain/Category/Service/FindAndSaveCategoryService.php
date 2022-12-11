<?php declare(strict_types=1);

namespace Mercadona\Domain\Category\Service;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\Service\SaveProduct;

final class FindAndSaveCategoryService implements FindAndSaveCategory
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
        private readonly SaveProduct $saveProduct
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

        /** @var Product $product */
        foreach ($category->products()->items() as $product) {
            $this->saveProduct->save($product);
        }
        
        $this->categoryRepository->save($category);

        return $category;
    }
}