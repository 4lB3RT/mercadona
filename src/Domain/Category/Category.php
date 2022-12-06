<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Shared\Domain\Entity;

final class Category extends Entity
{
    public function __construct(
        public readonly CategoryId $id,
        public readonly ?CategoryId $parentId,
        public readonly CategoryName $name,
        private CategoryStatus $status,
        public readonly ?bool $published = false,
        public readonly ?int $order,
        private CategoryCollection $categories,
        private ?ProductCollection $products
    ) {}

    public function status(): CategoryStatus
    {
        return $this->status;
    }

    public function modifyStatus(CategoryStatus $status): void
    {
        $this->status = $status;
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }

    public function hasCategories(): bool
    {
        return !$this->categories()?->isEmpty();
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

    public function isParent(): bool
    {
        return $this->hasCategories();
    }

    public function hasParent(): bool
    {
        return $this->parentId ? true : false;
    }
}
