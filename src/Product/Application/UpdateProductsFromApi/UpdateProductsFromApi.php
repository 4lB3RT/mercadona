<?php declare(strict_types=1);

namespace Mercadona\Product\Application\UpdateProductsFromApi;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\CategoryReadRepository;
use Mercadona\Category\Domain\CategoryRepository;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;
use Mercadona\Product\Domain\ProductRepository;

final class UpdateProductsFromApi
{
    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly FindAndSaveCategory $findAndSaveCategory,
        private readonly ProductRepository $productRepository,
    ) {}

    public function execute(): void
    {
        $categories = $this->categoryRepository->findAll();


    }
}
