<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_course_playlists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_playlist_id');
            $table->unsignedBigInteger('student_course_id');
            $table->foreign('student_playlist_id')->references('id')->on('student_playlists');
            $table->foreign('student_course_id')->references('id')->on('student_courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_course_playlists');
    }
};
