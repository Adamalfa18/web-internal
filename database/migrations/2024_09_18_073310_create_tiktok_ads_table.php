<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiktokAdsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tiktok_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performa_harian_id')->constrained()->onDelete('cascade');
            $table->decimal('live_shopping', 15, 2)->nullable();
            $table->decimal('live_shopping_revenue', 15, 2)->nullable();
            $table->decimal('product_shopping', 15, 2)->nullable();
            $table->decimal('product_shopping_revenue', 15, 2)->nullable();
            $table->decimal('video_shopping', 15, 2)->nullable();
            $table->decimal('video_shopping_revenue', 15, 2)->nullable();
            $table->decimal('gmv_max', 15, 2)->nullable();
            $table->decimal('gmv_max_revenue', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiktok_ads');
    }
}
