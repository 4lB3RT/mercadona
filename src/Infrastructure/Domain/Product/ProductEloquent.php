<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mercadona\Infrastructure\Domain\Category\CategoryEloquent;

final class ProductEloquent extends Model
{
    protected $table = "products";
    protected $primaryKey = "id";
    protected $fillable = ["id", "name", "slug", "limit", "published", "share_url", "thumbnail"];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(CategoryEloquent::class, "products_categories", "product_id", "category_id")->withTimestamps();
    }
}
