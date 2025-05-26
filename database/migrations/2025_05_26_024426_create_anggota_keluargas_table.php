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
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained('questionnaires')->cascadeOnDelete();
            $table->string('r_201')->nullable();
            $table->string('r_202')->nullable();
            $table->string('r_203')->default(null);
            $table->string('r_204')->default(null);
            $table->string('r_205')->default(null);
            $table->string('r_206')->nullable();
            $table->dateTime('r_207')->nullable();
            $table->string('r_208')->nullable();
            $table->string('r_209')->default(null);
            $table->string('r_210')->default(null);
            $table->string('r_211')->nullable();
            $table->string('r_212')->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};
