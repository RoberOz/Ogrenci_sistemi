<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationQuestionAnswersTable extends Migration
{

    public function up()
    {
        Schema::create('examination_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examination_id');
            $table->unsignedBigInteger('user_id');
            $table->json('answers');
            $table->timestamps();

            $table->foreign('examination_id')
                ->references('id')
                ->on('examinations')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examination_question_answers');
    }
}
