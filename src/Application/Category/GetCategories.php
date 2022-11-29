<?php declare(strict_types=1);

namespace Mercadona\Application\Category;

use Mercadona\Domain\Category\CategoryReadRepository;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\Service\FindCategoriesAndSave;

final class GetCategories
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
        private readonly FindCategoriesAndSave $findCategoriesAndSave
    ) {}

    public function execute(): void
    {
        $categories = $this->categoryReadRepository->findParentCategories();
        $this->categoryRepository->saveAll($categories);

        $this->findCategoriesAndSave->findAndSave($categories);
    }
}
