<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ExaminationQuestionAnswer;
use App\Models\ExaminationQuestion;
use App\Models\GradeUserExamination;

class GradeExamination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
      if(isset($this->data) && !empty($this->data))
      {
        $examinationQuestions = ExaminationQuestion::where('examination_id', $this->data['examination_id'])->get();
        $examinationQuestionAnswers = ExaminationQuestionAnswer::where('examination_id', $this->data['examination_id'])->get();
        $totalQuestion = 0;
        $correctAnswer = 0;

        foreach ($examinationQuestions as $examinationQuestion) {
          $totalQuestion += 1;
          foreach ($examinationQuestionAnswers as $examinationQuestionAnswer) {
            if ($examinationQuestion->id == $examinationQuestionAnswer->question_id) {
              $gradeUserExamination = new GradeUserExamination();
              $gradeUserExamination->examination_question_answers_id = $examinationQuestionAnswer->id;
              if (($examinationQuestion->correct_answer['key'] == $examinationQuestionAnswer->answer_key) && ($examinationQuestion->correct_answer['value'] == $examinationQuestionAnswer->answer_value)) {
                $gradeUserExamination->is_correct = true;
                $correctAnswer = 1;
              }
              else {
                $gradeUserExamination->is_correct = false;
                $correctAnswer = 0;
              }
            }
          }
        }
        $gradeUserExamination->grade = (100/$totalQuestion) * $correctAnswer;

        $gradeUserExamination->save();

      }
    }
}
