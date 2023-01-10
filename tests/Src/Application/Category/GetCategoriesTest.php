<?php declare(strict_types=1);

namespace Tests\Mercadona\Application\Category;

use Tests\TestCase;
use Mercadona\Application\Category\GetCategories\GetCategories;
use Tests\Mercadona\Infrastructure\Domain\Category\InMemoryCategoryReadRepository;
use Tests\Mercadona\Domain\Category\CategoryExample;
use Tests\Mercadona\Infrastructure\Domain\Category\InMemoryCategoryRepository;

class GetCategoriesTest extends TestCase
{
    private InMemoryCategoryRepository $categoryRepository;
    private InMemoryCategoryReadRepository $categoryReadRepository;

    private GetCategories $sut;

    public function setUp(): void
    {
        $this->categoryRepository = new InMemoryCategoryRepository;
        $this->categoryReadRepository = new InMemoryCategoryReadRepository;

        $this->sut = new GetCategories(
            $this->categoryRepository,
            $this->categoryReadRepository
        );
    }

    public function testItReturnsAllCategories(): void
    {
        $category = CategoryExample::dummy();

        $this->categoryReadRepository->save($category);

        $result = $this->sut->execute();

        $this->assertCount(1, $result->categories());
        $this->assertContains($category, $result->categories());
    }
}