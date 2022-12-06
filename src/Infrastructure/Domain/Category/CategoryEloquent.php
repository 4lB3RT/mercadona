<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mercadona\Infrastructure\Domain\Product\ProductEloquent;

final class CategoryEloquent extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ["id", "category_id", "is_parent", "name", "status", "published", "order"];

    public function categories(): HasMany
    {
        return $this->hasMany(CategoryEloquent::class, "category_id", "id");
    }

    public function products()
    {
      return $this->belongsToMany(ProductEloquent::class);
    }
}
