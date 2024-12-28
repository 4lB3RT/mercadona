<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const string TABLE = 'products_prices';

    public function up(): void
    {
        Schema::dropIfExists(self::TABLE);
    }

    public function down(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigInteger("id")->autoIncrement();
            $table->bigInteger('product_id');
            $table->bigInteger('price_id');
            $table->timestamps();

            $table->index(['product_id', 'price_id']);
        });
    }
};
