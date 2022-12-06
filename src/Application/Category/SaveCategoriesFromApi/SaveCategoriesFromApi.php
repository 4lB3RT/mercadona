<?php declare(strict_types=1);

namespace Mercadona\Application\Category\SaveCategoriesFromApi;

use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;

final class SaveCategoriesFromApi
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
    ) {}

    public function execute(): void
    {
        $categories = $this->categoryReadRepository->findParentCategories();
        $this->categoryRepository->saveAll($categories);

    }
}
