<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowDepartmentLectureExamRequest extends FormRequest
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
          'department_id' => 'numeric|exists:department_lecture,department_id|required',
          'lecture_id' => 'numeric|exists:department_lecture,lecture_id|required',
          'class' => 'numeric|in:1,2,3,4|required',
          'period' => 'numeric|in:1,2|required'
        ];
    }
}
