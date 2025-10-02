<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pelajaran_id');
            $table->enum('status', ['belum_mulai', 'sedang_belajar', 'selesai'])->default('belum_mulai');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('pelajaran_id')->references('id')->on('pelajaran')->onDelete('cascade');

            // Unique constraint
            $table->unique(['user_id', 'pelajaran_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress');
    }
};
