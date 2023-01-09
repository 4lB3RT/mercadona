<?php declare(strict_types=1);

namespace Tests\Mercadona\Application\Category;

use Mercadona\Application\Category\GetCategories\GetCategories;
use Mercadona\Domain\Category\CategoryRepository;
use Tests\Mercadona\Infrastructure\Category\InMemoryCategoryReadRepository;
use Tests\TestCase;

final class GetCategoriesTest extends TestCase
{

    private CategoryRepository $categoryRepository;
    private CategoryReadRepository $categoryReadRepository;
    private GetCategories $sut;

    public function setUp(): void
    {
        $this->categoryRepository = new InMemoryCategoryRepository();
        $this->categoryReadRepository = new InMemoryCategoryReadRepository();
        $this->sut = new GetCategories(
            $this->categoryRepository,
            $this->categoryReadRepository
        );
    }



}

