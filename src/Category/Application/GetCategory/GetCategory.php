<?php declare(strict_types=1);

namespace Mercadona\Category\Application\GetCategory;

use Mercadona\Shared\Application\Request;
use Mercadona\Category\Application\GetCategory\GetCategoryResponse;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Category\Domain\ValueObject\CategoryId;

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
        $category = $this->categoryRepository->find($categoryId);
        
        return new GetCategoryResponse($category);
    }
}
