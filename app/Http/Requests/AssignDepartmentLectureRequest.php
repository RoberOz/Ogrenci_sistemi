<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignDepartmentLectureRequest extends FormRequest
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
            'departmentId' => 'integer|exists:departments,id|required',
            'lectureNames.*' => 'exists:lectures,name|required',
            'class' => 'integer|digits:1|in:1,2,3,4|required|',
            'period' => 'integer|digits:1|in:1,2|required|'
        ];
    }
}
