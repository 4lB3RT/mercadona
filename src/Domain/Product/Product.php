<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Photo\PhotoCollection;
use Mercadona\Domain\Price\PriceCollection;
use Mercadona\Shared\Domain\Entity;

final class Product extends Entity
{
    public function __construct(
        public readonly ProductId $id,
        public readonly ProductName $name,
        public readonly ?int $ean,
        public readonly ?string $slug,
        public readonly ?string $brand,
        public readonly int $limit,
        public readonly ?string $origin,
        public readonly ?string $packaging,
        public readonly ?bool $published,
        public readonly ?string $shareUrl,
        public readonly string $thumbnail,
        public readonly ?string $isVariableWeight,
        private CategoryCollection $categories,
        private ?PriceCollection $prices,
        private PhotoCollection $photos,
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

    public function prices(): ?PriceCollection
    {
        return $this->prices;
    }

    public function modifyPrices(PriceCollection $prices): void
    {
        $this->prices = $prices;
    }

    public function hasPrices(): bool
    {
        return $this->prices() ? true : false;
    }

    public function photos(): ?PhotoCollection
    {
        return $this->photos;
    }

    public function modifyPhotos(PhotoCollection $photos): void
    {
        $this->photos = $photos;
    }
}