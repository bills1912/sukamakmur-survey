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
            $table->string('nama_petugas')->nullable();
            $table->string('kelompok_dasa_wisma')->nullable();
            $table->json('lokasi_rumah')->nullable();
            $table->string('waktu_pendataan')->nullable();
            $table->string('dusun')->nullable();
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
            $table->integer('r_207_usia')->nullable();
            $table->string('r_208')->nullable();
            $table->string('r_209')->nullable();
            $table->string('r_210')->nullable();
            $table->string('r_211')->nullable();
            $table->string('r_212')->nullable();
            $table->string('r_302_a')->nullable();
            $table->string('r_302_b')->nullable();
            $table->integer('r_302_c')->nullable();
            $table->float('r_302_d')->nullable();
            $table->float('r_302_e')->nullable();
            $table->float('r_302_f')->nullable();
            $table->float('r_302_g')->nullable();
            $table->integer('r_303_a')->nullable();
            $table->string('r_303_b')->nullable();
            $table->float('r_303_c')->nullable();
            $table->float('r_303_d')->nullable();
            $table->float('r_303_e')->nullable();
            $table->string('r_304_a')->nullable();
            $table->integer('r_304_b')->nullable();
            $table->float('r_304_c')->nullable();
            $table->float('r_304_d')->nullable();
            $table->string('r_305_a')->nullable();
            $table->string('r_305_b')->nullable();
            $table->string('r_305_c')->nullable();
            $table->integer('r_305_d')->nullable();
            $table->float('r_305_e')->nullable();
            $table->float('r_305_f')->nullable();
            $table->string('r_401')->nullable();
            $table->string('r_301')->nullable();
            $table->string('r_301_tambah')->nullable();
            $table->string('r_302_a_tambah')->nullable();
            $table->string('r_302_b_tambah')->nullable();
            $table->integer('r_302_c_tambah')->nullable();
            $table->float('r_302_d_tambah')->nullable();
            $table->float('r_302_e_tambah')->nullable();
            $table->float('r_302_f_tambah')->nullable();
            $table->float('r_302_g_tambah')->nullable();
            $table->integer('r_303_a_tambah')->nullable();
            $table->string('r_303_b_tambah')->nullable();
            $table->float('r_303_c_tambah')->nullable();
            $table->float('r_303_d_tambah')->nullable();
            $table->float('r_303_e_tambah')->nullable();
            $table->string('r_304_a_tambah')->nullable();
            $table->integer('r_304_b_tambah')->nullable();
            $table->float('r_304_c_tambah')->nullable();
            $table->float('r_304_d_tambah')->nullable();
            $table->string('r_305_a_tambah')->nullable();
            $table->string('r_305_b_tambah')->nullable();
            $table->string('r_305_c_tambah')->nullable();
            $table->integer('r_305_d_tambah')->nullable();
            $table->float('r_305_e_tambah')->nullable();
            $table->float('r_305_f_tambah')->nullable();
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
