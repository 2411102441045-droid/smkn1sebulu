<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Riwayat pergantian tema aktif
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theme_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('theme_id')
                  ->constrained('themes')
                  ->cascadeOnDelete();

            $table->foreignId('applied_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamp('applied_at')->useCurrent();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_histories');
    }
};
