<?php declare(strict_types=1);

namespace Mercadona\Category\Application\GetCategories;

use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryRepository;

final class GetCategories
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly CategoryReadRepository $categoryReadRepository,
    ) {}

    public function execute(): GetCategoriesResponse
    {
        $categories = $this->categoryRepository->findAll();

        return new GetCategoriesResponse($categories);
    }
}
