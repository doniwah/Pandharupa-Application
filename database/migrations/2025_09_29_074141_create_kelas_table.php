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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi_singkat');
            $table->text('deskripsi');
            $table->string('icon')->nullable();
            $table->enum('kategori', ['Pemula', 'Menengah', 'Lanjutan'])->default('Pemula');
            $table->string('warna_kategori')->default('#FF8C42');
            $table->integer('jumlah_pelajaran')->default(0);
            $table->integer('durasi')->comment('Durasi dalam minggu');
            $table->string('url_kelas')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};