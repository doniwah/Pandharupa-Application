<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_quiz_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_quizzes_taken')->default(0);
            $table->integer('total_score')->default(0);
            $table->decimal('average_score', 5, 2)->default(0);
            $table->enum('level', ['beginner', 'intermediate', 'advanced', 'expert', 'master'])->default('beginner');
            $table->timestamp('last_quiz_at')->nullable();
            $table->timestamps();
            
            $table->unique('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_quiz_stats');
    }
};
