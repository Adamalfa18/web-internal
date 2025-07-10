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
            $table->string('platform');
            $table->string('spent')->nullable();
            $table->string('impresi')->nullable();
            $table->string('click')->nullable();
            $table->string('revenue')->nullable();
            $table->string('roas')->nullable();
            $table->string('leads')->nullable();
            $table->string('chat')->nullable();
            $table->string('respond')->nullable();
            $table->string('greeting')->nullable();
            $table->string('pricelist')->nullable();
            $table->string('discuss')->nullable();
            $table->string('closing')->nullable();
            $table->string('site_visit')->nullable();
            $table->string('cpl')->nullable();
            $table->string('cpc')->nullable();
            $table->string('cr_leads_to_chat')->nullable();
            $table->string('cr_chat_to_respond')->nullable();
            $table->string('cr_respond_to_closing')->nullable();
            $table->string('cr_respond_to_site_visit')->nullable();
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
