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
        Schema::create('dua_for_eatings', function (Blueprint $table) {
            $table->id();
            $table->string('occasion'); // before_eating, after_eating, forgot_bismillah, drinking, iftar, suhoor
            $table->text('arabic_text');
            $table->text('transliteration');
            $table->text('translation');
            $table->foreignId('hadith_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dua_for_eatings');
    }
};
