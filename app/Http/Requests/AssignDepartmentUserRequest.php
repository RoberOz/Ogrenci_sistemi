<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignDepartmentUserRequest extends FormRequest
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
          'user_id' => 'numeric|exists:users,id|required',
          'department_id' => 'numeric|exists:departments,id|required',
          'department_foundation_year' => 'numeric|required',
          'department_registered_year' => 'numeric|digits:4|gte:department_foundation_year|required'
        ];
    }
}
