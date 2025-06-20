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
            $table->string('spent')->nullable();
            $table->string('revenue')->nullable();
            $table->string('roas')->nullable();
            $table->string('leads')->nullable();
            $table->string('report_date')->nullable();
            $table->string('chat')->nullable();
            $table->string('respond')->nullable();
            $table->string('greeting')->nullable();
            $table->string('pricelist')->nullable();
            $table->string('discuss')->nullable();
            $table->string('closing')->nullable();
            $table->text('note');
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
