<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->boolean("is_pack")->change(); 
            $table->float("pack_size")->nullable()->change(); 
            $table->integer("unit_name")->nullable()->change();
            $table->float("unit_size")->change();
            $table->float("bulk_price")->change();
            $table->float("unit_price")->change();
            $table->boolean("approx_size")->change();
            $table->string("size_format")->change();
            $table->float("drained_weight")->nullable()->change(); 
            $table->integer("selling_method")->nullable()->change();
            $table->boolean("price_decreased")->change();
            $table->float("reference_price")->change();
            $table->float("min_bunch_amount")->change();
            $table->float("increment_bunch_amount")->change();   
        });
    }

    public function down(): void
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->boolean("is_pack")->nullable()->change();
            $table->integer('pack_size')->nullable()->change();
            $table->integer('unit_name')->change();
            $table->integer('unit_size')->change();
            $table->integer('bulk_price')->change();
            $table->integer('unit_price')->change();
            $table->integer('approx_size')->change();
            $table->integer('size_format')->change();
            $table->integer("drained_weight")->nullable()->change();
            $table->integer("selling_method")->change();
            $table->boolean("price_decreased")->change();
            $table->integer("reference_price")->change();
            $table->integer("min_bunch_amount")->change();
            $table->integer("increment_bunch_amount")->change();        
        });
    }
};
