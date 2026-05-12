<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->year('year');
            $table->enum('type', ['sedan', 'suv', 'luxury', 'economy', 'van', 'convertible', 'truck'])->default('sedan');
            $table->enum('transmission', ['automatic', 'manual'])->default('automatic');
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid'])->default('petrol');
            $table->integer('seats')->default(5);
            $table->integer('luggage')->default(2);
            $table->decimal('price_per_day', 10, 2);
            $table->boolean('air_conditioning')->default(true);
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->string('license_plate')->nullable()->unique();
            $table->string('thumbnail')->nullable();
            $table->float('rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->index(['brand', 'type', 'is_available']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
