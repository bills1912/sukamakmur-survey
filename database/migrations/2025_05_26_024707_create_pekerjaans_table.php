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
        Schema::create('pekerjaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('questionnaire_id')->constrained('questionnaires')->cascadeOnDelete();
            $table->foreignId('anggota_keluarga_id')->constrained('anggota_keluargas')->cascadeOnDelete();
            $table->integer('r_302')->default(null);
            $table->integer('r_303')->default(null);
            $table->integer('r_304')->default(null);
            $table->integer('r_305')->default(null);
            $table->string('r_302_a')->nullable();
            $table->string('r_302_b')->default(null);
            $table->integer('r_302_c')->default(null);
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaans');
    }
};
