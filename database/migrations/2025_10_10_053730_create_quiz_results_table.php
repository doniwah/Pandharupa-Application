<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('quiz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->integer('time_taken')->default(0); // dalam detik
            $table->integer('correct_answers')->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('score')->default(0);
            $table->decimal('percentage', 5, 2)->default(0);
            $table->json('answers')->nullable(); // menyimpan jawaban user
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            // Index untuk query yang sering digunakan
            $table->index(['user_id', 'quiz_id']);
            $table->index('completed_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quiz_results');
    }
};