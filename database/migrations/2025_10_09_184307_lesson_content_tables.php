<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lesson_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lesson_id')->constrained('lessons')->onDelete('cascade');
            $table->string('word'); // Kata/huruf yang dipelajari
            $table->text('meaning'); // Arti/makna
            $table->text('example'); // Contoh penggunaan
            $table->json('pronunciations')->nullable(); // Array pronunciation data
            $table->text('tip')->nullable(); // Tips belajar
            $table->integer('order')->default(0); // Urutan konten
            $table->string('audio_file')->nullable(); // Link ke audio file
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lesson_contents');
    }
};
