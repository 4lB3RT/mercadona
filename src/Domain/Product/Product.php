<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Shared\Domain\Entity;

final class Product extends Entity
{
    public function __construct(
        private readonly ProductId $id,
        private readonly CategoryCollection $categories,
        private readonly ProductName $name,    
        private readonly ?string $slug,
        private readonly int $limit,
        private readonly ?bool $published,
        private readonly ?string $shareUrl,
        private readonly string $thumbnail
    ) {}

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function categories(): CategoryCollection
    {
        return $this->categories;
    }

    public function slug(): ?string
    {
        return $this->slug;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function published(): ?bool
    {
        return $this->published;
    }

    public function url(): ?string
    {
        return $this->url;
    }

    public function thumbnail(): string
    {
        return $this->thumbnail;
    }
}
