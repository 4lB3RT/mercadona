<?php declare(strict_types=1);

namespace Mercadona\Price\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

final class PriceEloquent extends Model
{
    protected $table = "prices";
    protected $primaryKey = "id";
    protected $fillable = ["id", "product_id", "date", "iva", "is_new", "is_pack", "pack_size", "unit_name", "unit_size", "bulk_price", "unit_price", "approx_size", "size_format", "total_units", "unit_selector", "bunch_selector", "drained_weight", "selling_method", "price_decreased", "reference_price", "min_bunch_amount", "reference_format", "increment_bunch_amount"];
}
