<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->enum('kategori', ['Semua', 'Workshop', 'Festival', 'Webinar', 'Kompetisi', 'Pertunjukan']);
            $table->text('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('lokasi');
            $table->string('tipe_lokasi')->default('offline');
            $table->integer('kapasitas_peserta');
            $table->decimal('harga_ticket', 10, 2)->default(0);
            $table->string('nama_penyelenggara');
            $table->string('email_penyelenggara');
            $table->string('no_telepon');
            $table->string('icon')->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('no_telepon');
            $table->string('asal_instansi')->nullable();
            $table->enum('status', ['registered', 'confirmed', 'cancelled'])->default('registered');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
        Schema::dropIfExists('events');
    }
};
