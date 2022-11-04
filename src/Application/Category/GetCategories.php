<?php declare(strict_types=1);

namespace Mercadona\Application\Category;

use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Category\FinderCategoryRepository;

final class GetCategories
{
    public function __construct(
        private readonly FinderCategoryRepository $finderCategoryRepository,
        private readonly CategoryRepository $categoryRepository
    ) {}

    public function execute(): void
    {
        $categories = $this->finderCategoryRepository->findCategories();  
        $this->categoryRepository->saveAll($categories);
    }
}
