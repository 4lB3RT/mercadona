<?php declare(strict_types=1);

namespace Mercadona\Photo\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

final class PhotoEloquent extends Model
{
    protected $table = "photos";
    protected $primaryKey = "id";
    protected $fillable = ["id", "zoom", "regular", "thumbnail", "perspective"];
}
