<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Shared\Domain\Entity;

final class Product extends Entity
{
    public function __construct(
        public readonly ProductId $id,
        private CategoryCollection $categories,
        public readonly ProductName $name,
        public readonly ?string $slug,
        public readonly int $limit,
        public readonly ?bool $published,
        public readonly ?string $shareUrl,
        public readonly string $thumbnail
    ) {
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }

    public function modifyCategories(CategoryCollection $categories): void
    {
        $this->categories = $categories;
    }

}