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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('arabic_name')->nullable();
            $table->string('status'); // halal, haram, makruh, doubtful
            $table->string('category'); // meat, seafood, dairy, grain, fruit, beverage, additive
            $table->text('reason');
            $table->string('quran_reference')->nullable();
            $table->foreignId('hadith_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
