<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\ExaminationQuestionAnswer;
use App\Models\GradeUserExamination;

class GradeExamination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $examinationQuestionAnswer;

    public function __construct($examinationQuestionAnswer)
    {
        $this->examinationQuestionAnswer = $examinationQuestionAnswer;
    }

    public function handle()
    {
        GradeUserExamination::create($examinationQuestionAnswer);
    }
}
