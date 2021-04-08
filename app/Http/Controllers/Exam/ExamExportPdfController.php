<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestion;
use App\Models\Examination;

use PDF;

class ExamExportPdfController extends Controller
{
    public function getExaminations(Examination $examination)
    {
        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)
                                                   ->orderBy('order','ASC')
                                                   ->get();
        return view('exam.export_pdf')->with([
          'examinationQuestions' => $examinationQuestions
        ]);
    }

    public function exportPdf(Examination $examination)
    {
        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)
                                                   ->orderBy('order','ASC')
                                                   ->get();

        $pdf = PDF::loadView('exam.export_pdf',compact('examinationQuestions'));
        return $pdf->download('examinationQuestions.pdf');
    }
}
