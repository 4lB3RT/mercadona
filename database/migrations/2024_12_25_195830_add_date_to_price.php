<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const TABLE = 'prices';

    public function up(): void
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->dateTime('date')->after('id');
        });
    }

    public function down(): void
    {
        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }
};
