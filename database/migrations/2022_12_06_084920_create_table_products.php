<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->unsigned();
            $table->unsignedInteger('price_id')->nullable();
            $table->unsignedInteger('product_detail_id')->nullable();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
