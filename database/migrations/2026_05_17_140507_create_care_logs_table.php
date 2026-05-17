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
        Schema::create('care_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chicken_id')->constrained('chickens')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // who recorded it
            $table->date('date');
            $table->string('feed_type')->nullable();
            $table->string('feed_quantity')->nullable();
            $table->time('feed_time')->nullable();
            $table->string('health_status')->nullable(); // Healthy, Sick, Injured, etc.
            $table->text('health_symptoms')->nullable();
            $table->integer('eggs_collected')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_logs');
    }
};
