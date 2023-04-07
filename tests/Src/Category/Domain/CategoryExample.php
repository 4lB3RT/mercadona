<?php declare(strict_types=1);

namespace Tests\Mercadona\Category\Domain;

use Mercadona\Category\Domain\Category;
use Mercadona\Category\Domain\CategoryId;
use Mercadona\Category\Domain\CategoryName;
use Mercadona\Category\Domain\CategoryStatus;
use Tests\Mercadona\Shared\Domain\BoolExample;
use Tests\Mercadona\Shared\Domain\IntegerExample;
use Tests\Mercadona\Category\Domain\CategoryIdExample;
use Tests\Mercadona\Category\Domain\CategoryNameExample;
use Tests\Mercadona\Domain\Product\ProductCollectionExample;
use Tests\Mercadona\Category\Domain\CategoryCollectionExample;

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
            published: $published ?? BoolExample::random(),
            order: $order ?? IntegerExample::random()  
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
            published: true,
            order: 0
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
            published: BoolExample::random(),
            order: IntegerExample::random(),
        );
    }
}