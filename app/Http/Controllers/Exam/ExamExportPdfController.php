<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestion;

use PDF;

class ExamExportPdfController extends Controller
{
    public function getExaminations()
    {
        $examinationQuestions = ExaminationQuestion::orderBy('order','ASC')->get();
        return view('exam.export-pdf')->with([
          'examinationQuestions' => $examinationQuestions
        ]);
    }

    public function exportPdf()
    {
        $examinationQuestions = ExaminationQuestion::orderBy('order','ASC')->get();
        $pdf = PDF::loadView('exam.export-pdf',compact('examinationQuestions'));
        return $pdf->download('examinationQuestions.pdf');
    }
}
