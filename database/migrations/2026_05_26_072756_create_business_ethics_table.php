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
        Schema::create('business_ethics', function (Blueprint $table) {
            $table->id();
            $table->text('principle');
            $table->string('quran_reference')->nullable();
            $table->foreignId('hadith_id')->nullable()->constrained()->onDelete('set null');
            $table->string('category'); // forbidden, recommended
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_ethics');
    }
};
