<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaAdsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meta_ads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performa_harian_id')->constrained()->onDelete('cascade');
            $table->decimal('regular', 15, 2)->nullable();
            $table->decimal('cpas', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meta_ads');
    }
}
