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
        Schema::create('adhkars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // morning, evening, before_sleep, after_prayer, general
            $table->text('arabic_text');
            $table->text('transliteration');
            $table->text('translation');
            $table->integer('repetitions')->default(1);
            $table->string('source')->nullable();
            $table->string('time_of_day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adhkars');
    }
};
