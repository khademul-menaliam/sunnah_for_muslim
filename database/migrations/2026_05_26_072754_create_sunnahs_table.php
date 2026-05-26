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
        Schema::create('sunnahs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('arabic_title')->nullable();
            $table->text('description');
            $table->string('category'); // morning, evening, sleep, hygiene, social, worship, eating, travel, general
            $table->string('difficulty'); // easy, medium, advanced
            $table->boolean('is_daily')->default(true);
            $table->string('time_of_day')->nullable();
            $table->foreignId('hadith_id')->nullable()->constrained()->onDelete('set null');
            $table->integer('order_number')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sunnahs');
    }
};
