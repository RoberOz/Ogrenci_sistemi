<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentLectureExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'first_exam' => 'date',
          'second_exam' => 'date',
          'exam_start_time' => 'date_format:H:i|before:exam_end_time|required',
          'exam_end_time' => 'date_format:H:i|after:exam_start_time|required',
          'department_lecture_id' => 'integer|exists:department_lecture,id|required',
          'exam_order' => 'string|in:first_exam,second_exam|required'
        ];
    }
}
