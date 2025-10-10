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
        Schema::create('leaderboards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_score')->default(0);
            $table->integer('quizzes_completed')->default(0);
            $table->integer('correct_answers')->default(0);
            // PERBAIKAN: Ubah enum level agar sesuai dengan yang di controller
            $table->enum('level', ['beginner', 'intermediate', 'advanced', 'expert', 'master'])
                ->default('beginner');
            $table->timestamps();

            // Add index for better performance
            $table->index(['total_score', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaderboards');
    }
};
