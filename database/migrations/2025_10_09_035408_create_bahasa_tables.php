<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel bahasa
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bahasa Madura, Bahasa Jawa, dll
            $table->string('native_name'); // Basa Madhura, Basa Jawa
            $table->string('difficulty'); // mudah, sedang
            $table->string('indicator_color'); // red, green, blue
            $table->integer('speakers'); // Jumlah penutur
            $table->integer('total_lessons'); // Total pelajaran
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabel pelajaran
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('level')->nullable(); // pemula, menengah, lanjutan
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Tabel progress pengguna
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->integer('progress_percentage')->default(0);
            $table->integer('completed_lessons')->default(0);
            $table->integer('study_time')->default(0); // dalam menit
            $table->integer('streak')->default(0); // hari berturut-turut belajar
            $table->date('last_study_date')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'language_id']);
        });

        // Tabel lesson completion - PERBAIKAN DI SINI
        Schema::create('lesson_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade');
            $table->boolean('completed')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->integer('study_time_seconds')->default(0)->comment('Study time in seconds');
            // PERBAIKAN: Hapus ->after() karena ini CREATE TABLE, bukan ALTER TABLE
            $table->enum('completion_type', ['scroll', 'button'])
                ->default('scroll')
                ->comment('Type of completion: scroll (regular lesson) or button (path lesson)');
            $table->timestamps();

            $table->unique(['user_id', 'lesson_id']);
        });

        // Tabel vocabulary
        Schema::create('vocabularies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->foreignId('lesson_id')->nullable()->constrained()->onDelete('set null');
            $table->string('indonesian');
            $table->string('local_language');
            $table->string('pronunciation')->nullable();
            $table->string('audio_file')->nullable();
            $table->timestamps();
        });

        // Tabel audio phrases
        Schema::create('audio_phrases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->string('indonesian');
            $table->string('local_language');
            $table->string('audio_file')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Tabel learning paths
        Schema::create('learning_paths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_id')->constrained('languages')->onDelete('cascade');
            $table->string('name');
            $table->string('level'); // Pemula, Menengah, Lanjutan
            $table->text('description')->nullable();
            $table->integer('total_lessons')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // Tabel pivot learning_path_lessons
        Schema::create('learning_path_lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('learning_path_id')->constrained('learning_paths')->onDelete('cascade');
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            // Prevent duplicate entries
            $table->unique(['learning_path_id', 'lesson_id']);
        });

        // Tabel learning_path_progress untuk tracking progress user
        Schema::create('learning_path_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('learning_path_id')->constrained('learning_paths')->onDelete('cascade');
            $table->integer('completed_lessons')->default(0);
            $table->decimal('progress_percentage', 5, 2)->default(0);
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'learning_path_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('learning_path_progress');
        Schema::dropIfExists('learning_path_lessons');
        Schema::dropIfExists('learning_paths');
        Schema::dropIfExists('audio_phrases');
        Schema::dropIfExists('vocabularies');
        Schema::dropIfExists('lesson_completions');
        Schema::dropIfExists('user_progress');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('languages');
    }
};
