<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategories;

use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;

final class GetCategories
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
    ) {}

    public function execute(): GetCategoriesResponse
    {
        $categories = $this->categoryReadRepository->findParentCategories();
        $this->categoryRepository->saveAll($categories);

        $categories = $this->categoryRepository->findAll();

        return new GetCategoriesResponse($categories);
    }
}
