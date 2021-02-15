<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('tc_kimlik_no');
            $table->date('birth_date');
            $table->string('email');
            $table->string('student_no');

            $table->boolean('is_parents_together');
            $table->boolean('living_with_family');
            $table->string('family_address');
            $table->string('living_with');
            $table->string('current_address');
            $table->string('getting_school_with');
            $table->string('working_status');
            $table->boolean('been_in_accident');
            $table->boolean('had_any_surgery');
            $table->string('did_have_any_sickness');
            $table->string('how_many_siblings');

            $table->string('height');
            $table->string('weight');

            $table->string('mother_name');
            $table->string('mother_job');
            $table->string('mother_job_address');
            $table->string('mother_current_address');
            $table->string('mother_birth_date');
            $table->boolean('is_mother_alive');
            $table->string('mother_email');
            $table->string('mother_phone_number');

            $table->string('father_name');
            $table->string('father_job');
            $table->string('father_job_address');
            $table->string('father_current_address');
            $table->string('father_birth_date');
            $table->boolean('is_father_alive');
            $table->string('father_email');
            $table->string('father_phone_number');

            $table->timestamps();

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
        Schema::dropIfExists('student_forms');
    }
}
