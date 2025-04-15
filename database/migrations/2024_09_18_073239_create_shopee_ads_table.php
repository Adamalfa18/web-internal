<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopeeAdsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shopee_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performa_harian_id')->constrained()->onDelete('cascade');
            $table->decimal('manual', 15, 2)->nullable();
            $table->decimal('auto_meta', 15, 2)->nullable();
            $table->decimal('gmv', 15, 2)->nullable();
            $table->decimal('toko', 15, 2)->nullable();
            $table->decimal('live', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopee_ads');
    }
}
