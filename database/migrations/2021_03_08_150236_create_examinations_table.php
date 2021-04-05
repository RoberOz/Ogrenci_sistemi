<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_lecture_id');
            $table->string('exam_order');
            $table->date('exam_date');
            $table->time('exam_start_time');
            $table->time('exam_end_time');
            $table->timestamps();

            $table->foreign('department_lecture_id')
                ->references('id')
                ->on('department_lecture')
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
        Schema::dropIfExists('examinations');
    }
}
