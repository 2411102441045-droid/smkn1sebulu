<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ppdb_documents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')
                  ->constrained('ppdb_registrations')
                  ->cascadeOnDelete();

            $table->enum('document_type', [
                'kk',
                'akta_kelahiran',
                'rapor',
                'pas_foto',
                'kip',
                'surat_keterangan_lulus',
                'lainnya'
            ]);

            $table->string('file_name');
            $table->string('file_path');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('file_size')->nullable(); // byte

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ppdb_documents');
    }
};
