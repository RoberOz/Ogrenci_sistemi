<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('examination_id');
            $table->integer('order');
            $table->string('content');
            $table->json('correct_answer');
            $table->json('options');
            $table->timestamps();

            $table->foreign('examination_id')
                ->references('id')
                ->on('examinations')
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
        Schema::dropIfExists('examination_questions');
    }
}
