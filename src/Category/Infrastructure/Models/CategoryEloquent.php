<?php declare(strict_types=1);

namespace Mercadona\Category\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Mercadona\Product\Infrastructure\Models\ProductEloquent;

final class CategoryEloquent extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $fillable = ["id", "category_id", "is_parent", "name", "status", "published", "order"];

    public function categories(): HasMany
    {
        return $this->hasMany(CategoryEloquent::class, "category_id", "id");
    }

    public function allChildrenCategories()
    {
        return $this->categories()->with('allChildrenCategories');
    }

    public function products(): HasMany
    {
        return $this->hasMany(ProductEloquent::class, "category_id", "id");
    }

}
