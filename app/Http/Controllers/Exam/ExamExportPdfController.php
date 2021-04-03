<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DepartmentLecture;
use App\Models\ExaminationQuestion;
use App\Models\Examination;

use PDF;

class ExamExportPdfController extends Controller
{
    public function getExaminations(DepartmentLecture $departmentLecture,$examId)
    {
        $examination = Examination::where('department_lecture_id',$departmentLecture->id)
                                  ->where('exam_id',$examId)
                                  ->first();

        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)
                                                   ->orderBy('order','ASC')
                                                   ->get();
        return view('exam.export-pdf')->with([
          'examinationQuestions' => $examinationQuestions
        ]);
    }

    public function exportPdf(DepartmentLecture $departmentLecture,$examId)
    {
        $examination = Examination::where('department_lecture_id',$departmentLecture->id)
                                  ->where('exam_id',$examId)
                                  ->first();

        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)
                                                   ->orderBy('order','ASC')
                                                   ->get();
                                                   
        $pdf = PDF::loadView('exam.export-pdf',compact('examinationQuestions'));
        return $pdf->download('examinationQuestions.pdf');
    }
}
