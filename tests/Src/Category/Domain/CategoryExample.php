<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\ValueObject\CategoryPublished;
use Mercadona\Category\Domain\ValueObject\CategoryId;
use Mercadona\Category\Domain\ValueObject\CategoryName;
use Mercadona\Category\Domain\ValueObject\CategoryOrder;
use Mercadona\Category\Domain\ValueObject\CategoryStatus;
use Tests\Mercadona\Category\Domain\CategoryCollectionExample;
use Tests\Mercadona\Category\Domain\ValueObject\CategoryIdExample;
use Tests\Mercadona\Category\Domain\ValueObject\CategoryNameExample;
use Tests\Mercadona\Category\Domain\ValueObject\CategoryOrderExample;
use Tests\Mercadona\Category\Domain\ValueObject\CategoryPublishedExample;
use Tests\Mercadona\Product\Domain\ProductCollectionExample;

final class CategoryExample {

    public static function create(
        ?CategoryId $id =  null,
        ?CategoryName $name = null,
        ?CategoryStatus $status = null,
        ?CategoryCollectionExample $categoriesExample = null,
        ?ProductCollectionExample $productsExample = null,
        ?CategoryId $parentId = null,
        ?bool $published = null,
        ?int $order = null,
    ): Category
    {
        return new Category(
            id: $id ?? CategoryIdExample::random(),
            name: $name ?? CategoryNameExample::random(),
            status: $status ?? CategoryStatus::READY,  
            categories: $categoriesExample ?? CategoryCollectionExample::empty(),
            products: $productsExample ?? ProductCollectionExample::empty(),
            parentId: $parentId ?? CategoryIdExample::random(),
            published: $published ?? CategoryPublishedExample::random(),
            order: $order ?? CategoryOrderExample::random()  
        );
    }

    public static function dummy(): Category
    {
        return new Category(
            id: new CategoryId(1),
            name: new CategoryName("Dummy"),
            status: CategoryStatus::READY,        
            categories: CategoryCollectionExample::empty(),
            products: ProductCollectionExample::empty(),
            parentId: new CategoryId(1000),
            published: new CategoryPublished(true),
            order: new CategoryOrder(1)
        );
    }

    public static function random(): Category
    {
        return new Category(
            id: CategoryIdExample::random(),
            name: CategoryNameExample::random(),
            status: CategoryStatus::READY,
            categories: CategoryCollectionExample::empty(),
            products: ProductCollectionExample::empty(),
            parentId: CategoryIdExample::random(),
            published: CategoryPublishedExample::random(),
            order: CategoryOrderExample::random(),
        );
    }
}