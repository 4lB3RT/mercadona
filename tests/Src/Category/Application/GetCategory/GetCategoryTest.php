<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Application\GetCategory;

use Tests\TestCase;
use Mercadona\Product\Domain\ProductRepository;
use Mercadona\Category\Domain\CategoryRepository;
use Tests\Mercadona\Category\Domain\CategoryExample;
use Tests\Mercadona\Category\Domain\CategoryIdExample;
use Mercadona\Category\Domain\Service\FindAndSaveCategory;
use Mercadona\Category\Application\GetCategory\GetCategory;
use Tests\Mercadona\Category\Infrastructure\InMemoryCategoryRepository;

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

    public function testGetCategory(): void
    {
        $categoryId = CategoryIdExample::random();
        $category = CategoryExample::create(
            id: $categoryId
        );
        $this->categoryRepository->save($category);

        $request = GetCategoryRequestExample::create(
            categoryId: $categoryId->value()
        );

        $this->sut->execute($request);
    }

}