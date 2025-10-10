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

// ===== FILE 2: 2024_01_01_000002_create_questions_table.php =====

return new class extends Migration
{
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained('quizzes')->onDelete('cascade');
            $table->text('question_text');
            $table->text('option_a');
            $table->text('option_b');
            $table->text('option_c');
            $table->text('option_d');
            $table->char('correct_answer', 1); // 'a', 'b', 'c', atau 'd'
            $table->text('explanation')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }
};

// ===== FILE 3: 2024_01_01_000003_create_quiz_results_table.php =====

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

// ===== FILE 4: 2024_01_01_000004_create_user_quiz_stats_table.php =====

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

// ===== FILE 5: 2024_01_01_000005_create_achievements_table.php =====

return new class extends Migration
{
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->enum('type', ['quiz_completed', 'perfect_score', 'correct_answers', 'streak', 'time_based'])->default('quiz_completed');
            $table->integer('target')->default(1);
            $table->integer('points')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('achievements');
    }
};

// ===== FILE 6: 2024_01_01_000006_create_user_achievements_table.php =====

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('achievement_id')->constrained('achievements')->onDelete('cascade');
            $table->integer('progress')->default(0);
            $table->boolean('is_unlocked')->default(false);
            $table->timestamp('unlocked_at')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'achievement_id']);
            $table->index('is_unlocked');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_achievements');
    }
};

// ===== FILE 7: 2024_01_01_000007_create_leaderboards_table.php =====

return new class extends Migration
{
    public function up()
    {
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('total_score')->default(0);
            $table->integer('quizzes_completed')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->enum('level', ['pemula', 'intermediate', 'advanced', 'expert', 'master'])->default('pemula');
            $table->timestamps();
            
            $table->unique('user_id');
            $table->index('total_score');
            $table->index('level');
        });
    }

    public function down()
    {
        Schema::dropIfExists('leaderboards');
    }
};