<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['naskah', 'lagu', 'video', 'dokumentasi', 'audio']);
            $table->string('author');
            $table->year('year');
            $table->string('duration')->nullable();
            $table->integer('pages')->nullable();
            $table->string('file_path');
            $table->integer('views')->default(0);
            $table->integer('downloads')->default(0);
            $table->timestamps();
        });

        Schema::create('library_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('library_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->enum('type', ['view', 'download']);
            $table->timestamp('created_at');

            $table->index(['library_id', 'ip_address', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_interactions');
        Schema::dropIfExists('libraries');
    }
};