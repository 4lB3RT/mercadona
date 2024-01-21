<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Application\GetCategories;

use Tests\TestCase;
use Mercadona\Category\Application\GetCategories\GetCategories;
use Tests\Mercadona\Category\Domain\CategoryExample;
use Tests\Mercadona\Category\Infrastructure\InMemoryCategoryRepository;

class GetCategoriesTest extends TestCase
{
    private InMemoryCategoryRepository $categoryRepository;

    private GetCategories $sut;

    public function setUp(): void
    {
        $this->categoryRepository = new InMemoryCategoryRepository;

        $this->sut = new GetCategories($this->categoryRepository);
    }

    public function testItReturnsAllCategories(): void
    {
        $category = CategoryExample::dummy();

        $this->categoryRepository->save($category);

        $result = $this->sut->execute();

        $this->assertCount(1, $result->categories());
        $this->assertContains($category, $result->categories());
    }
}