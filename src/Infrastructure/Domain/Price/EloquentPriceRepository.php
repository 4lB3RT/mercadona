<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Price;

use Mercadona\Domain\Price\Price;
use Mercadona\Domain\Price\PriceCollection;
use Mercadona\Domain\Price\PriceId;
use Mercadona\Domain\Price\PriceRepository;

final class EloquentPriceRepository implements PriceRepository
{
    public function find(PriceId $priceId): Price
    {
        return PriceDataTransformer::fromModel(PriceEloquent::find($priceId->value()));
    }

    public function save(Price $price): Price
    {
        $priceEloquent = new PriceEloquent();
        $priceEloquentSaved = $priceEloquent->updateOrCreate(
            ['id' => $price->id()?->value()],
            PriceDataTransformer::fromEntity($price)
        );

        return PriceDataTransformer::fromModel($priceEloquentSaved);
    }

    public function saveAll(PriceCollection $prices): PriceCollection
    {
        $priceCollection = [];
         /** @var Price $price */
         foreach ($prices->items() as $price) {
            $priceCollection[] = $this->save($price);
        }

        return new PriceCollection($priceCollection);
    }

}