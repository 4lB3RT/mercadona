<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->integer('iva');
            $table->boolean('is_new');
            $table->boolean("is_pack")->nullable();
            $table->integer('pack_size')->nullable();
            $table->integer('unit_name');
            $table->integer('unit_size');
            $table->integer('bulk_price');
            $table->integer('unit_price');
            $table->integer('approx_size');
            $table->integer('size_format');
            $table->integer('total_units')->nullable();
            $table->boolean('unit_selector');
            $table->boolean("bunch_selector");
            $table->integer("drained_weight")->nullable();
            $table->integer("selling_method");
            $table->boolean("price_decreased");
            $table->integer("reference_price");
            $table->integer("min_bunch_amount");
            $table->string("reference_format");
            $table->integer("increment_bunch_amount");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
