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
        Schema::create('prayers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Fajr/Dhuhr/Asr/Maghrib/Isha
            $table->string('arabic_name');
            $table->string('transliteration');
            $table->integer('order_number');
            $table->integer('rakat_fard');
            $table->integer('rakat_sunnah_before');
            $table->integer('rakat_sunnah_after');
            $table->integer('rakat_nafl');
            $table->string('time_window_description');
            $table->text('significance');
            $table->text('special_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prayers');
    }
};
