<?php declare(strict_types=1);

namespace Mercadona\Product\Domain;

use Mercadona\Category\Domain\CategoryId;
use Mercadona\Shared\Domain\Entity;
use Mercadona\Photo\Domain\PhotoCollection;
use Mercadona\Price\Domain\PriceCollection;
use Mercadona\Product\Domain\ValueObject\ProductBrand;
use Mercadona\Product\Domain\ValueObject\ProductEan;
use Mercadona\Product\Domain\ValueObject\ProductId;
use Mercadona\Product\Domain\ValueObject\ProductLimit;
use Mercadona\Product\Domain\ValueObject\ProductName;
use Mercadona\Product\Domain\ValueObject\ProductOrigin;
use Mercadona\Product\Domain\ValueObject\ProductPackaging;
use Mercadona\Product\Domain\ValueObject\ProductPublished;
use Mercadona\Product\Domain\ValueObject\ProductShareUrl;
use Mercadona\Product\Domain\ValueObject\ProductSlug;
use Mercadona\Product\Domain\ValueObject\ProductThumbnail;
use Mercadona\Product\Domain\ValueObject\ProductWeight;

final class Product extends Entity
{
    public function __construct(
        private ProductId $id,
        private readonly ProductName $name,
        private CategoryId $categoryId,
        private PhotoCollection $photos,
        private readonly ProductEan $ean,
        private readonly ProductSlug $slug,
        private readonly ProductBrand $brand,
        private readonly ProductLimit $limit,
        private readonly ProductOrigin $origin,
        private readonly ProductPackaging $packaging,
        private readonly ProductPublished $published,
        private readonly ProductShareUrl $shareUrl,
        private readonly ProductThumbnail $thumbnail,
        private readonly ProductWeight $isVariableWeight,
        private PriceCollection $prices,
    ) {
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function modifyId(ProductId $id): void 
    {
        $this->id = $id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function ean(): ProductEan
    {
        return $this->ean;
    }   

    public function slug(): ProductSlug
    {
        return $this->slug;
    }

    public function brand(): ProductBrand
    {
        return $this->brand;
    }

    public function limit(): ProductLimit
    {
        return $this->limit;
    }

    public function origin(): ProductOrigin
    {
        return $this->origin;
    }

    public function packaging(): ProductPackaging
    {
        return $this->packaging;
    }

    public function published(): ProductPublished
    {
        return $this->published;
    }

    public function shareUrl(): ProductShareUrl
    {
        return $this->shareUrl;
    } 

    public function thumbnail(): ProductThumbnail
    {
        return $this->thumbnail;
    }

    public function isVariableWeight(): ProductWeight
    {
        return $this->isVariableWeight;
    }

    public function categoryId(): CategoryId
    {
        return $this->categoryId;
    }

    public function modifyCategoryId(CategoryId $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function prices(): PriceCollection
    {
        return $this->prices;
    }

    public function modifyPrices(PriceCollection $prices): void
    {
        $this->prices = $prices;
    }

    public function photos(): PhotoCollection
    {
        return $this->photos;
    }

    public function modifyPhotos(PhotoCollection $photos): void
    {
        $this->photos = $photos;
    }
}