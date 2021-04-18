<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamQuestionsRequest extends FormRequest
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
          '*.order' => 'integer|min:1|required',
          '*.content' => 'required',
          '*.options' => 'array|min:3|required',
          '*.options.*.key' => 'required',
          '*.options.*.value' => 'required',
        ];
    }
}
