<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOnlineExaminationRequest extends FormRequest
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
            'userId' => 'integer|exists:users,id|required',
            'examinationId' => 'integer|exists:examinations,id|required',
            'answers' => 'array|required',
            '*.answers.*.questionIndex' => 'required',
            '*.answers.*.questionAnswer' => 'required',
        ];
    }
}
