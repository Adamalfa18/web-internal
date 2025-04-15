<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoogleAdsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('google_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performa_harian_id')->constrained()->onDelete('cascade');
            $table->decimal('search', 15, 2)->nullable();
            $table->decimal('gtm', 15, 2)->nullable();
            $table->decimal('youtube', 15, 2)->nullable();
            $table->decimal('performance_max', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_ads');
    }
}
