<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->bigInteger('price_id');
            $table->timestamps();

            $table->index(['product_id', 'price_id']);
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('products_prices');
    }
};
