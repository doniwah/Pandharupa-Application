<?php

// ===== FILE 1: 2024_01_01_000001_create_quizzes_table.php =====

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('difficulty', ['mudah', 'sedang', 'sulit'])->default('mudah');
            $table->string('icon')->nullable();
            $table->integer('question_count')->default(0);
            $table->integer('participant_count')->default(0);
            $table->integer('time_limit')->default(10); // dalam menit
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
};
