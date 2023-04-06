<?php declare(strict_types=1);

namespace Mercadona\Category\Application\GetCategory;

use Mercadona\Category\Domain\CategoryId;
use Mercadona\Shared\Application\Request;
use Mercadona\Category\Application\GetCategory\GetCategoryResponse;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;
use Mercadona\Product\Domain\ProductRepository;

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
        $categoryId = new CategoryId($request->categoryId());
        $categoryWithOutProcess = $this->categoryRepository->find($categoryId);
        
        $parent = null;
        if ($categoryWithOutProcess->hasParent()) {
            $parent = $this->categoryRepository->find($categoryWithOutProcess->parentId());
        }
        
        $categoryProcessed = $this->findAndSaveCategory->findAndSave($categoryWithOutProcess, $parent);

        return new GetCategoryResponse($categoryProcessed);
    }
}
