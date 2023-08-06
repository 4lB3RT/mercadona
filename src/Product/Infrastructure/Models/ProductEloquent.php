<?php declare(strict_types=1);

namespace Mercadona\Product\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mercadona\Photo\Infrastructure\Models\PhotoEloquent;
use Mercadona\Price\Infrastructure\Models\PriceEloquent;

final class ProductEloquent extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = ["id", "category_id", "product_detail_id", "name", "ean", "slug", "brand", "limit", "origin", "packaging", "published", "share_url", "thumbnail", "is_variable_weight"];

    public function prices(): BelongsToMany
    {
        return $this->belongsToMany(PriceEloquent::class, "products_prices", "product_id", "price_id")->withTimestamps();
    }

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(PhotoEloquent::class, "products_photos", "product_id", "photo_id")->withTimestamps();
    }

}
