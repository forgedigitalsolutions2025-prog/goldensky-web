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
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->foreignId('treatment_id')->nullable()->constrained()->nullOnDelete();
            $table->date('booking_date');
            $table->time('booking_time');
            $table->text('message')->nullable();
            $table->boolean('is_couple_package')->default(false);
            $table->decimal('discount_applied', 5, 2)->default(20.00);
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};





