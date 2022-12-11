<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategory;

use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\Service\FindAndSaveCategory;
use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Shared\Application\Request;

final class GetCategory
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly ProductRepository $productRepository,
        private readonly FindAndSaveCategory $findAndSaveCategory
    ) {}

    /** @var GetCategoryRequest $request */
    public function execute(Request $request): GetCategoryResponse
    {
        $categoryId = new CategoryId($request->categoryId);
        $categoryWithOutProcess = $this->categoryRepository->find($categoryId);
        
        $parent = null;
        if ($categoryWithOutProcess->hasParent()) {
            $parent = $this->categoryRepository->find($categoryWithOutProcess->parentId);
        }
        
        $categoryProcessed = $this->findAndSaveCategory->findAndSave($categoryWithOutProcess, $parent);

        return new GetCategoryResponse($categoryProcessed);
    }
}
