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
        Schema::create('link_tiktok', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('name');

            // Tambahkan foreign key ke tabel clients
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profile_tiktok')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
