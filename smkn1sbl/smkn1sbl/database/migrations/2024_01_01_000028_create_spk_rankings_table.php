<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('spk_rankings', function (Blueprint $table) {
    $table->id();

    $table->foreignId('applicant_id')
          ->constrained()
          ->cascadeOnDelete();

    $table->foreignId('alternative_id')
          ->constrained('spk_alternatives')
          ->cascadeOnDelete();

    $table->decimal('final_score', 10, 4);

    $table->unsignedInteger('rank_position');

    $table->string('method')->default('SAW');

    $table->timestamp('calculated_at');

    $table->timestamps();

    $table->unique(['applicant_id', 'alternative_id']);
});
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_rankings');
    }
};
