<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_registrations', function (Blueprint $table) {
            $table->id();

            $table->string('registration_number')->unique();

            // Satu applicant hanya memiliki satu pendaftaran PPDB
            $table->foreignId('applicant_id')
                  ->unique()
                  ->constrained()
                  ->cascadeOnDelete();

            $table->enum('status', [
                'draft',             // masih mengisi formulir
                'submitted',         // formulir sudah dikirim
                'documents_valid',   // berkas valid
                'documents_invalid', // berkas perlu diperbaiki
                'graded',            // nilai rapor selesai diproses OCR
                'recommended',       // rekomendasi jurusan (SAW & Sistem Pakar) selesai
                'accepted',          // diterima
                'rejected',          // ditolak
            ])->default('draft');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_registrations');
    }
};
