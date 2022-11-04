<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->unsigned();
            $table->unsignedInteger('category_id')->nullable()->unsigned();
            $table->boolean("is_parent");
            $table->string('name');
            $table->boolean("published");
            $table->integer("order");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');        
    }
};
