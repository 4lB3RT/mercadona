<?php declare(strict_types=1);

namespace Mercadona\Category\Domain;

use Mercadona\Shared\Domain\Entity;
use Mercadona\Product\Domain\ProductCollection;
use Mercadona\Category\Domain\CategoryCollection;
use Mercadona\Category\Domain\ValueObject\CategoryId;
use Mercadona\Category\Domain\ValueObject\CategoryName;
use Mercadona\Category\Domain\ValueObject\CategoryOrder;
use Mercadona\Category\Domain\ValueObject\CategoryPublished;
use Mercadona\Category\Domain\ValueObject\CategoryStatus;

final class Category extends Entity
{
    public function __construct(
        private CategoryId $id,
        private readonly CategoryName $name,
        private CategoryStatus $status,
        private CategoryCollection $categories,
        private ProductCollection $products,
        private readonly ?CategoryId $parentId,
        private readonly ?CategoryOrder $order,
        private readonly ?CategoryPublished $published,
    ) {}

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function modifyId(CategoryId $id): void 
    {
        $this->id = $id;    
    }

    public function parentId(): ?CategoryId
    {
        return $this->parentId;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }

    public function status(): CategoryStatus
    {
        return $this->status;
    }

    public function modifyStatus(CategoryStatus $status): void
    {
        $this->status = $status;
    }

    public function published(): ?CategoryPublished
    {
        return $this->published;
    }

    public function order(): ?CategoryOrder
    {
        return $this->order;
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }

    public function modifyCategories(CategoryCollection $categories): void
    {
        $this->categories = $categories;
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }

    public function hasProducts(): bool
    {
        return !$this->products()->isEmpty();
    }

    public function modifyProducts(ProductCollection $products): void
    {
        $this->products = $products;
    }

    public function isParent(): bool 
    {
        return $this->categories()->isNotEmpty();
    }

    public function hasParent(): bool
    {
        return $this->parentId ? true : false;
    }
}
