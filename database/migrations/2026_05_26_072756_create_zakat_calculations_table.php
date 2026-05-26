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
        Schema::create('zakat_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->decimal('cash_savings', 15, 2)->default(0);
            $table->decimal('gold_value', 15, 2)->default(0);
            $table->decimal('silver_value', 15, 2)->default(0);
            $table->decimal('business_assets', 15, 2)->default(0);
            $table->decimal('receivables', 15, 2)->default(0);
            $table->decimal('liabilities', 15, 2)->default(0);
            $table->decimal('nisab_threshold', 15, 2)->default(0);
            $table->decimal('net_zakatable_assets', 15, 2)->default(0);
            $table->decimal('zakat_due', 15, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zakat_calculations');
    }
};
