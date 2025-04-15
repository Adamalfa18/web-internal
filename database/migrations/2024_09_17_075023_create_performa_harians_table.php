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
        Schema::create('performa_harians', function (Blueprint $table) {
            $table->id();
            $table->string('performance_bulanan_id')->constrained()->onDelete('cascade');
            $table->date('hari');
            $table->decimal('omzet', 15, 2);
            $table->decimal('roas', 5, 2);
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performa_harians');
    }
};
