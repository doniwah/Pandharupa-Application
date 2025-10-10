<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karyas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['tari', 'musik', 'puisi', 'dokumenter', 'fotografi', 'kerajinan']);
            $table->string('file_path')->nullable();
            $table->string('file_type')->nullable(); // video, audio, image, document
            $table->string('thumbnail')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('downloads')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel untuk kolaborator
        Schema::create('karya_collaborators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Tabel untuk komentar
        Schema::create('karya_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->timestamps();
        });

        // Tabel untuk likes
        Schema::create('karya_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karya_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['karya_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karya_likes');
        Schema::dropIfExists('karya_comments');
        Schema::dropIfExists('karya_collaborators');
        Schema::dropIfExists('karyas');
    }
};