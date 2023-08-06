<?php declare(strict_types=1);

namespace Mercadona\Price\Infrastructure\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceId;
use Mercadona\Price\Domain\PriceCollection;
use Mercadona\Price\Domain\PriceRepository;
use Mercadona\Price\Infrastructure\Models\PriceEloquent;
use Mercadona\Price\Infrastructure\Transformers\PriceDataTransformer;
use Throwable;

final class EloquentPriceRepository implements PriceRepository
{
    public function find(PriceId $priceId): Price
    {
        return PriceDataTransformer::fromModel(PriceEloquent::find($priceId->value()));
    }

    public function save(Price $price): void
    {
        try{
            DB::beginTransaction();
            
            $priceDao = PriceEloquent::updateOrCreate(
                ['id' => $price->id()?->value()],
                PriceDataTransformer::fromEntity($price)
            );
    
            $price->modifyId(new PriceId($priceDao->id));
    
            DB::commit();
        }catch (Throwable $e) {
            dd($e->getMessage());
            DB::rollBack();
        }
    }

    public function saveAll(PriceCollection $prices): void
    {
         /** @var Price $price */
         foreach ($prices->items() as $price) {
            $this->save($price);
        }
    }

}