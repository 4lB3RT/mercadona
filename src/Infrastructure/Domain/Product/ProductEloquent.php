<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mercadona\Infrastructure\Domain\Category\CategoryEloquent;
use Mercadona\Infrastructure\Domain\Photo\PhotoEloquent;
use Mercadona\Infrastructure\Domain\Price\PriceEloquent;

final class ProductEloquent extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    protected $guarded = ['id'];  
    protected $fillable = ["id", "product_detail_id", "name", "ean", "slug", "brand", "limit", "origin", "packaging", "published", "share_url", "thumbnail", "is_variable_weight"];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryEloquent::class, "products_categories", "product_id", "category_id")->withTimestamps();
    }

    public function prices(): BelongsToMany
    {
        return $this->belongsToMany(PriceEloquent::class, "products_prices", "product_id", "price_id")->withTimestamps();
    }

    public function photos(): BelongsToMany
    {
        return $this->belongsToMany(PhotoEloquent::class, "products_photos", "product_id", "photo_id")->withTimestamps();
    }

}
