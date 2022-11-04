<?php declare(strict_types=1);

namespace Mercadona\Domain\Category;

use Mercadona\Domain\Product\ProductCollection;
use Mercadona\Shared\Domain\Entity;

final class Category extends Entity
{
    public function __construct(
        private readonly CategoryId $id,
        private readonly ?CategoryId $parentId,
        private readonly CategoryName $name,
        private readonly bool $published,
        private readonly int $order,
        private readonly CategoryCollection $categories,
        private readonly ProductCollection $products
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

    public function published(): bool
    {
        return $this->published;
    }

    public function order(): int
    {
        return $this->order;
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }

    public function products(): ProductCollection
    {
        return $this->products;
    }

    public function hasCategories(): bool
    {
        return !$this->categories()?->isEmpty();
    }
}
