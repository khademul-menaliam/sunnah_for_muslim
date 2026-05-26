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
        Schema::create('prayer_times_caches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('location'); // city or lat/lng
            $table->string('fajr_time');
            $table->string('dhuhr_time');
            $table->string('asr_time');
            $table->string('maghrib_time');
            $table->string('isha_time');
            $table->string('calculation_method');
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayer_times_caches');
    }
};
