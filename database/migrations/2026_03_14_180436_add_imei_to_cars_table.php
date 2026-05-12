<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cars', function (Blueprint $table) {
        if (!Schema::hasColumn('cars', 'imei')) {
            $table->string('imei')->unique()->nullable()->after('id');
        }
        if (!Schema::hasColumn('cars', 'latitude')) {
            $table->decimal('latitude', 10, 8)->nullable();
        }
        if (!Schema::hasColumn('cars', 'longitude')) {
            $table->decimal('longitude', 11, 8)->nullable();
        }
        if (!Schema::hasColumn('cars', 'speed')) {
            $table->float('speed')->default(0)->nullable();
        }
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['imei', 'latitude', 'longitude', 'speed']);
        });
    }
};