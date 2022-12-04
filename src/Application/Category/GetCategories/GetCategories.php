<?php declare(strict_types=1);

namespace Mercadona\Application\Category\GetCategories;

use Mercadona\Domain\Category\CategoryRepository;

final class GetCategories
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
    ) {}

    public function execute(): GetCategoriesResponse
    {
        $categories = $this->categoryRepository->findAll();

        return new GetCategoriesResponse($categories);
    }
}
