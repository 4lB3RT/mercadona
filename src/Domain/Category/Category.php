<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Shared\Domain\Entity;

final class Category extends Entity
{
    public function __construct(
        private readonly CategoryId $id,
        private readonly CategoryName $name,
        private CategoryStatus $status,
        private CategoryCollection $categories,
        private ?ProductCollection $products,
        private readonly ?CategoryId $parentId,
        private readonly ?int $order,
        private readonly ?bool $published = false,
    ) {}

    public function id(): CategoryId
    {
        return $this->id;
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

    public function published(): ?bool
    {
        return $this->published;
    }

    public function order(): ?int
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
        return !$this->products()?->isEmpty();
    }

    public function modifyProducts(ProductCollection $products): void
    {
        $this->products = $products;
    }

    public function hasParent(): bool
    {
        return $this->parentId ? true : false;
    }
}
