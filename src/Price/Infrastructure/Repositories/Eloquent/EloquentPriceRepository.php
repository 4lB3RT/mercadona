<?php declare(strict_types=1);

namespace Mercadona\Price\Infrastructure\Repositories\Eloquent;

use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceId;
use Mercadona\Price\Domain\PriceCollection;
use Mercadona\Price\Domain\PriceRepository;
use Mercadona\Price\Infrastructure\Models\PriceEloquent;
use Mercadona\Price\Infrastructure\Transformers\PriceDataTransformer;


final class EloquentPriceRepository implements PriceRepository
{
    public function find(PriceId $priceId): Price
    {
        return PriceDataTransformer::fromModel(PriceEloquent::find($priceId->value()));
    }

    public function save(Price $price): Price
    {
        $priceEloquentSaved = PriceEloquent::updateOrCreate(
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