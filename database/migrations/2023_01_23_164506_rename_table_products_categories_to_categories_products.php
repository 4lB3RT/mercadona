<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const CURRENTTABLENAME = 'products_categories';
    const NEWTABLENAME = 'categories_products';

    public function up(): void
    {
        Schema::rename(self::CURRENTTABLENAME, self::NEWTABLENAME);
    }

    public function down(): void
    {
        Schema::rename(self::NEWTABLENAME, self::CURRENTTABLENAME);
    }
};
