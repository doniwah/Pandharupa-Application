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
        Schema::create('koleksi', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('kategori', ['Naskah', 'Lagu', 'Video', 'Dokumentasi']);
            $table->text('deskripsi')->nullable();
            $table->string('penulis')->nullable(); // bisa penulis, komunitas, atau studio
            $table->year('tahun')->nullable();

            // atribut khusus
            $table->integer('halaman')->nullable();
            $table->time('durasi')->nullable(); // format HH:MM:SS untuk lagu/video

            // statistik
            $table->unsignedInteger('jumlah_suka')->default(0);
            $table->unsignedInteger('jumlah_unduh')->default(0);

            // file (opsional)
            $table->string('file_path')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('koleksi');
    }
};