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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('performance_bulanan_id')->constrained()->onDelete('cascade');
            $table->date('hari');
            $table->integer('leads');
            $table->integer('chat');
            $table->integer('chat_respon');
            $table->integer('chat_no_respon');
            $table->integer('closing');
            $table->integer('revenue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
