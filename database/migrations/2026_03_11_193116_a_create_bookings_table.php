<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('pickup_location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('dropoff_location_id')->constrained('locations')->onDelete('cascade');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->integer('total_days');
            $table->decimal('price_per_day', 10, 2);
            $table->decimal('extras_price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->json('extras')->nullable(); // GPS, child seat, insurance
            $table->string('coupon_code')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->index(['user_id', 'status']);
            $table->index(['car_id', 'pickup_date', 'return_date']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
