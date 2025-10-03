<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::table('topics', function (Blueprint $table) {
            $table->dropColumn('is_answered');
        });

        Schema::create('topic_user_answered', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['topic_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('topic_user_answered');
        Schema::table('topics', function (Blueprint $table) {
            $table->boolean('is_answered')->default(false);
        });
    }
};