<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;
use App\Models\Question;

class ExamController extends Controller
{

    public function index(Request $request)
    {
      $departmentLecture = DepartmentLecture::where('department_id', $request->department_id)
                                            ->where('lecture_id', $request->lecture_id)
                                            ->where('class', $request->class)
                                            ->where('period', $request->period)
                                            ->first();
      $examinations = Examination::all();

      return view('exam.choose_exam')->with([
        'departmentLecture' => $departmentLecture,
        'examinations' => $examinations,
      ]);
    }

    public function showExamQuestion(Request $request)
    {
        $examination = Examination::where('department_lecture_id', $request->department_lecture_id)
                                  ->where('exam_id', $request->exam_id)
                                  ->first();

        $questions = Question::all();

        return view('exam.questions')->with([
          'examination' => $examination,
          'questions' => $questions,
        ]);
    }

    public function store(Request $request)
    {
        $question = new Question();
        $question->examination_id = $request->examination_id;
        $question->order = 1;
        $question->content = $request->content;
        $question->options = json_encode($request->options);

        $question->save();

        return redirect(route('department-list.index'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
