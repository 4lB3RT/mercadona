<?php declare(strict_types=1);

namespace Mercadona\Price\Infrastructure\Transformers;

use Mercadona\Price\Domain\Iva;
use Mercadona\Price\Domain\Price;
use Mercadona\Price\Domain\PriceId;
use Illuminate\Database\Eloquent\Model;
use Mercadona\Price\Domain\PriceCollection;
use Illuminate\Database\Eloquent\Collection;

final class PriceDataTransformer
{
    public static function fromArray(array $result): Price
    {
        $price = new Price(
            isset($result["id"]) ? new PriceId((int) $result["id"]) : null,
            Iva::tryFrom($result["iva"]),
            $result["is_new"],
            $result["is_pack"],
            $result["pack_size"],
            (int) $result["unit_name"],
            isset($result["unit_size"]) ? $result["unit_size"] : 0,
            (float) $result["bulk_price"],
            (float) $result["unit_price"],
            $result["approx_size"],
            $result["size_format"],
            $result["total_units"],
            $result["unit_selector"],
            $result["bunch_selector"],
            $result["drained_weight"],
            isset($result["selling_method"]) ? $result["selling_method"] : null,
            $result["price_decreased"],
            (float) $result["reference_price"],
            $result["min_bunch_amount"],
            $result["reference_format"],
            $result["increment_bunch_amount"],
        );

        return $price;
    }

    public static function fromArrays(array $priceArray): PriceCollection
    {
        $prices = [];
        $prices[] = self::fromArray($priceArray);

        return new PriceCollection($prices);
    }

    public static function fromEntity(Price $price): array
    {
       return [
            "id" => $price->id()?->value(),
            "iva" => $price->iva()->value,
            "is_new" => $price->isNew(),
            "is_pack" => $price->isPack(),
            "pack_size" => $price->packSize(),
            "unit_name" => $price->unitName(),
            "unit_size" => $price->unitSize(),
            "bulk_price" => $price->bulkPrice(),
            "unit_price" => $price->unitPrice(),
            "approx_size" => $price->approxSize(),
            "size_format" => $price->sizeFormat(),
            "total_units" => $price->totalUnits(),
            "unit_selector" => $price->unitSelector(),
            "bunch_selector" => $price->bunchSelector(),
            "drained_weight" => $price->drainedWeight(),
            "selling_method" => $price->sellingMethod(),
            "price_decreased" => $price->priceDecreased(),
            "reference_price" => $price->referencePrice(),
            "min_bunch_amount" => $price->minBunchAmount(),
            "reference_format" => $price->referenceFormat(),
            "increment_bunch_amount" => $price->incrementBunchAmount(),
        ];
    }

    public static function fromEntities(PriceCollection $prices): array
    {
        $pricesArray = [];

        /** @var Price $price */
        foreach ($prices as $price) {
            $pricesArray[] = self::fromEntity($price);
        }

        return $pricesArray;
    }

    public static function fromModel(Model $model): Price
    {
        return new Price(
            new PriceId($model->id),
            Iva::tryFrom($model->iva),
            (bool) $model->is_new,
            (bool) $model->is_pack,
            (float) $model->pack_size,
            $model->unit_name,
            $model->unit_size,
            $model->bulk_price,
            $model->unit_price,
            (bool) $model->approx_size,
            $model->size_format,
            $model->total_units,
            (bool) $model->unit_selector,
            (bool) $model->bunch_selector,
            $model->drained_weight,
            $model->selling_method,
            (bool) $model->price_decreased,
            $model->reference_price,
            $model->min_bunch_amount,
            $model->reference_format,
            $model->increment_bunch_amount
        );
    }

    public static function fromCollection(Collection $collection): PriceCollection
    {
        $prices = [];
        /** @var Model $model */
        foreach ($collection as $model) {
            $prices[] = self::fromModel($model);
        }

        return new PriceCollection($prices);
    }
}
