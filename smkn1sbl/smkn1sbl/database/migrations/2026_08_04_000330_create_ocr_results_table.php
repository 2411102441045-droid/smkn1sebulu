<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Hasil ekstraksi teks/nilai dari foto rapor menggunakan OCR
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ocr_results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('report_card_id')
                  ->unique()
                  ->constrained('report_cards')
                  ->cascadeOnDelete();

            $table->longText('raw_text')->nullable();        // teks mentah hasil OCR
            $table->json('extracted_data')->nullable();      // hasil parsing nilai
            $table->decimal('confidence_score', 5, 2)->nullable(); // 0–100
            $table->boolean('is_confirmed')->default(false); // sudah dikonfirmasi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ocr_results');
    }
};
