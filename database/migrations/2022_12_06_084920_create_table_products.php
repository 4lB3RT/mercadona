<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigInteger('id')->primary()->unsigned();
            $table->bigInteger('category_id');
            $table->bigInteger('price_id');
            $table->bigInteger('product_detail_id')->nullable();
            $table->string('name');
            $table->integer('ean')->nullable();
            $table->string("slug")->nullable();
            $table->string('brand')->nullable();
            $table->integer('limit');
            $table->string("origin")->nullable();
            $table->string("packaging")->nullable();
            $table->boolean("published")->nullable();
            $table->string("share_url")->nullable();
            $table->string("thumbnail");
            $table->boolean("is_variable_weight")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
