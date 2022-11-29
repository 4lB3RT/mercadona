<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary()->unsigned();
            $table->unsignedInteger('category_id')->nullable()->unsigned();
            $table->boolean("is_parent");
            $table->string('name');
            $table->string('status');
            $table->boolean("published")->nullable();
            $table->integer("order")->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');        
    }
};
