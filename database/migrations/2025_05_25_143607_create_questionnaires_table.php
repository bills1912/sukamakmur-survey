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
        Schema::create('questionnaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->cascadeOnDelete();
            $table->string('r_102')->nullable();
            $table->string('r_103')->nullable();
            $table->string('r_104')->nullable();
            $table->json('r_200')->nullable();
            $table->string('r_201')->nullable();
            $table->string('r_202')->nullable();
            $table->string('r_203')->nullable();
            $table->string('r_204')->nullable();
            $table->string('r_205')->nullable();
            $table->string('r_206')->nullable();
            $table->dateTime('r_207')->nullable();
            $table->string('r_208')->nullable();
            $table->string('r_209')->nullable();
            $table->string('r_210')->nullable();
            $table->string('r_211')->nullable();
            $table->string('r_212')->nullable();
            $table->integer('r_302')->nullable();
            $table->integer('r_303')->nullable();
            $table->integer('r_304')->nullable();
            $table->integer('r_305')->nullable();
            $table->string('r_302_a')->nullable();
            $table->string('r_302_b')->nullable();
            $table->integer('r_302_c')->nullable();
            $table->float('r_302_d')->nullable();
            $table->float('r_302_e')->nullable();
            $table->integer('r_303_a')->nullable();
            $table->string('r_303_b')->nullable();
            $table->float('r_303_c')->nullable();
            $table->string('r_304_a')->nullable();
            $table->integer('r_304_b')->nullable();
            $table->float('r_304_c')->nullable();
            $table->string('r_305_a')->nullable();
            $table->string('r_305_b')->nullable();
            $table->string('r_305_c')->nullable();
            $table->integer('r_305_d')->nullable();
            $table->float('r_305_e')->nullable();
            $table->string('r_401')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questionnaires');
    }
};
