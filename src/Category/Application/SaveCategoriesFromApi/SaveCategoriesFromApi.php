<?php declare(strict_types=1);

namespace Mercadona\Category\Application\SaveCategoriesFromApi;

use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryRepository;

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
