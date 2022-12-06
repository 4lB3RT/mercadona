<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Category\Category;
use Mercadona\Shared\Domain\Entity;

final class Product extends Entity
{
    public function __construct(
        public readonly ProductId $id,
        public readonly Category $category,
        public readonly ProductName $name,
        public readonly ?string $slug,
        public readonly int $limit,
        public readonly ?bool $published,
        public readonly ?string $shareUrl,
        public readonly string $thumbnail
    ) {
    }
}