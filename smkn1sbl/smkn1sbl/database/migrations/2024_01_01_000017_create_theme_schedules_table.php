<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('theme_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('theme_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->dateTime('start_at');

            $table->dateTime('end_at')->nullable();

            // Jika true, jadwal akan berulang setiap tahun
            $table->boolean('is_yearly')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('theme_schedules');
    }
};
