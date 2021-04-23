<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradeUserExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_user_examinations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examination_question_answers_id');
            $table->boolean('is_correct');
            $table->float('grade');
            $table->timestamps();

            $table->foreign('examination_question_answers_id')
                ->references('id')
                ->on('examination_question_answers')
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
        Schema::dropIfExists('grade_user_examinations');
    }
}
