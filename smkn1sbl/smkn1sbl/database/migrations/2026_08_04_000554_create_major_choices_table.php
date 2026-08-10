<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Pilihan jurusan calon siswa berdasarkan prioritas
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('major_choices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('registration_id')
                  ->constrained('ppdb_registrations')
                  ->cascadeOnDelete();

            $table->foreignId('major_id')
                  ->constrained('majors')
                  ->cascadeOnDelete();

            $table->unsignedTinyInteger('choice_order'); // 1 = pilihan pertama, 2 = kedua, 3 = ketiga

            $table->timestamps();

            // Tidak boleh ada dua pilihan dengan urutan yang sama
            $table->unique(['registration_id', 'choice_order']);

            // Tidak boleh memilih jurusan yang sama lebih dari sekali
            $table->unique(['registration_id', 'major_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('major_choices');
    }
};
