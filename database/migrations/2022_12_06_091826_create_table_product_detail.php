<?php declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_detail', function (Blueprint $table) {
            $table->id();
            $table->string("brand");
            $table->string("origin");
            $table->string("legal_name");
            $table->string("description");
            $table->string("counter_info")->nullable();
            $table->string("danger_mentions")->nullable();
            $table->string("alcohol_by_volume")->nullable();
            $table->string("mandatory_mentions");
            $table->string("production_variant")->nullable();
            $table->string("usage_instructions");
            $table->string("storage_instructions");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_detail');
    }
};
