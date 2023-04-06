<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Application\GetCategories;

use Tests\TestCase;
use Mercadona\Category\Application\GetCategories\GetCategories;
use Tests\Mercadona\Category\Domain\CategoryExample;
use Tests\Mercadona\Category\Infrastructure\InMemoryCategoryRepository;
use Tests\Mercadona\Category\Infrastructure\Category\InMemoryCategoryReadRepository;

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