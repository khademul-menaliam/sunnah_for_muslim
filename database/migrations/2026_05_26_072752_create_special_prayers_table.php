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
        Schema::create('special_prayers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('arabic_name');
            $table->string('category'); // voluntary, eid, tarawih, witr, tahajjud, istikhara
            $table->integer('rakat');
            $table->text('description');
            $table->foreignId('hadith_id')->nullable()->constrained()->onDelete('set null');
            $table->string('time_guide');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_prayers');
    }
};
