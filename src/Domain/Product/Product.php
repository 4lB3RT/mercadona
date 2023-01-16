<?php declare(strict_types=1);

namespace Mercadona\Domain\Product;

use Mercadona\Domain\Category\CategoryCollection;
use Mercadona\Domain\Category\CategoryIdCollection;
use Mercadona\Domain\Photo\PhotoCollection;
use Mercadona\Domain\Price\PriceCollection;
use Mercadona\Shared\Domain\Entity;

final class Product extends Entity
{
    public function __construct(
        private readonly ProductId $id,
        private readonly ProductName $name,
        private readonly ?int $ean,
        private readonly ?string $slug,
        private readonly ?string $brand,
        private readonly int $limit,
        private readonly ?string $origin,
        private readonly ?string $packaging,
        private readonly ?bool $published,
        private readonly ?string $shareUrl,
        private readonly string $thumbnail,
        private readonly ?string $isVariableWeight,
        private CategoryIdCollection $categoryIds,
        private ?PriceCollection $prices,
        private PhotoCollection $photos,
    ) {
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function ean(): ?int
    {
        return $this->ean;
    }   

    public function slug(): ?string
    {
        return $this->slug;
    }

    public function brand(): ?string
    {
        return $this->brand;
    }

    public function limit(): int
    {
        return $this->limit;
    }

    public function origin(): ?string
    {
        return $this->origin;
    }

    public function packaging(): ?string
    {
        return $this->packaging;
    }

    public function published(): ?bool
    {
        return $this->published;
    }

    public function shareUrl(): ?string
    {
        return $this->shareUrl;
    } 

    public function thumbnail(): string
    {
        return $this->thumbnail;
    }

    public function isVariableWeight(): ? string
    {
        return $this->isVariableWeight;
    }

    public function categoryIds(): CategoryIdCollection
    {
        return $this->categoryIds;
    }

    public function modifyCategoryIds(CategoryIdCollection $categoryIds): void
    {
        $this->categoryIds = $categoryIds;
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
        return !$this->prices()->isEmpty() ? true : false;
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