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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Menambahkan kolom user_id
            $table->string('nama_client');
            $table->string('nama_brand');
            $table->text('informasi_tambahan');
            $table->string('alamat');
            $table->string('email');
            $table->string('nama_finance');
            $table->string('telepon_finance');
            $table->string('status_client');
            $table->string('pegawai_id')->constrained()->onDelete('cascade');
            $table->date('date_in');
            $table->string('gambar_client')->nullable();
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
