<?php declare(strict_types=1);

namespace Mercadona\Infrastructure\Domain\Category;

use Illuminate\Database\Eloquent\Model;

final class CategoryEloquent extends Model
{
    protected $table = "categories";
    protected $primaryKey = 'id';
    protected $fillable = ["category_id", "is_parent", "name", "published", "order"];
}
