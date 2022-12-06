<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Price;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mercadona\Infrastructure\Domain\Product\ProductEloquent;

final class PriceEloquent extends Model
{
    protected $table = "prices";
    protected $primaryKey = "id";
    protected $fillable = ["id", "iva", "is_new", "is_pack", "pack_size", "unit_name", "unit_size", "bulk_price", "unit_price", "approx_size", "size_format", "total_units", "unit_selector", "bunch_selector", "drained_weight", "selling_method", "price_decreased", "reference_price", "min_bunch_amount", "reference_format", "increment_bunch_amount"];

    public function products(): HasMany
    {
        return $this->hasMany(ProductEloquent::class);
    }
}
