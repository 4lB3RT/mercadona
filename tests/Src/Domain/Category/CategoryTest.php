<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Category\Category;
use Mercadona\Domain\Category\CategoryId;
use Mercadona\Domain\Category\CategoryName;
use Mercadona\Domain\Category\CategoryStatus;
use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Domain\Category\CategoryCollection;
use PHPUnit\Framework\TestCase;
use Tests\Mercadona\Domain\Product\ProductCollectionExample;

final class CategoryTest extends TestCase {

    public function testCategoryCanBeCreated(): void
    {
        $id = new CategoryId(1);
        $parentId = new CategoryId(2);
        $name = new CategoryName('Test');
        $status = CategoryStatus::READY;
        $published = true;
        $order = 1;
        $categories = CategoryCollection::empty();
        $products = ProductCollection::empty();

        $category = new Category(
            id: $id,
            name: $name,
            status: $status,
            categories: $categories,
            products: $products,
            parentId: $parentId,
            published: $published, 
            order: $order,
        );

        $this->assertSame($id, $category->id());
        $this->assertSame($parentId, $category->parentId());
        $this->assertSame($name, $category->name());
        $this->assertSame($status, $category->status());
        $this->assertSame($published, $category->published());
        $this->assertSame($order, $category->order());
        $this->assertSame($categories, $category->categories());
        $this->assertSame($products, $category->products());
    }

    public function testCategoryIdIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertSame(1, $category->id()->value());
    }

    public function testCategoryNameIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertSame("Dummy", $category->name()->value());
    }

    public function testCategoryStatusIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertSame("READY", $category->status()->value);
    }

    public function testCategoryStatusCanBeModified(): void
    {
        $category = CategoryExample::dummy();
        $status = CategoryStatus::FAIL;
        $category->modifyStatus($status);
        $this->assertSame("FAIL", $category->status()->value);
    }

    public function testCategoryPublishedIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertTrue($category->published());
    }

    public function testCategoryOrderIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertSame(0, $category->order());
    }

    public function testCategoryCategoriesCanBeModified(): void
    {
        $category = CategoryExample::dummy();
        $newCategories = CategoryCollection::empty();
        $category->modifyCategories($newCategories);
        $this->assertSame($newCategories, $category->categories());
    }

    public function testCategoryProductsAreReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertInstanceOf(ProductCollection::class, $category->products());
    }

    public function testCategoryProductsCanBeModified(): void
    {
        $category = CategoryExample::dummy();
        $newProducts = ProductCollection::empty();
        $category->modifyProducts($newProducts);
        $this->assertSame($newProducts, $category->products());
    }

    public function testCategoryHasParentIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertTrue($category->hasParent());

        $categoryWithoutParent = new Category(
            id: new CategoryId(1),
            name: new CategoryName("Dummy"),
            status: CategoryStatus::READY,
            categories: CategoryCollectionExample::empty(),
            products: ProductCollectionExample::empty(),
            parentId: null,
            order: 0,
            published: true
        );
        $this->assertFalse($categoryWithoutParent->hasParent());
    }

    public function testCategoryHasProductsIsReturned(): void
    {
        $category = CategoryExample::dummy();
        $this->assertFalse($category->hasProducts());
    }
}