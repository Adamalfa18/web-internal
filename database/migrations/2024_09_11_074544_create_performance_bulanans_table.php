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
        Schema::create('performance_bulanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->string('jenis_layanan_mb');
            $table->string('nama_campaign');
            $table->string('jenis_leads')->nullable();
            $table->string('target_spent')->nullable();
            $table->string('target_revenue')->nullable();
            $table->string('target_roas')->nullable();
            $table->string('target_leads')->nullable();
            $table->string('report_date')->nullable();
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
        Schema::dropIfExists('performance_bulanans');
    }
};
