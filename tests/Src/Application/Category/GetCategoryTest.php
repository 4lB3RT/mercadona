<?php declare(strict_types=1);

namespace Tests\Mercadona\Application\Category\GetCategory;

use Mercadona\Application\Category\GetCategory\GetCategory;
use Mercadona\Domain\Category\CategoryRepository;
use Mercadona\Domain\Product\ProductRepository;
use Mercadona\Domain\Category\Service\FindAndSaveCategory;
use Tests\Mercadona\Infrastructure\Domain\Category\InMemoryCategoryRepository;
use Tests\Mercadona\Infrastructure\Domain\Product\InMemoryProductRepository;
use Tests\TestCase;

final class GetCategoryTest extends TestCase {

    private readonly CategoryRepository $categoryRepository;
    private readonly ProductRepository $productRepository;
    private readonly FindAndSaveCategory $findAndSaveCategory;

    private readonly GetCategory $sut;

    public function setUp(): void
    {
        parent::setUp();
        $this->categoryRepository = new InMemoryCategoryRepository;
        $this->productRepository = new InMemoryProductRepository;
        
        $this->findAndSaveCategory = new FindAndSaveCategory;
        $this->sut = new GetCategory(
            $this->categoryRepository,
            $this->productRepository,
            $this->findAndSaveCategory
        );
    }

}