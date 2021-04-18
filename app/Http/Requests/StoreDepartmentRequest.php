<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Carbon\Carbon;

class StoreDepartmentRequest extends FormRequest
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
          'name' => 'unique:departments,name|required',
          'years' => 'integer|in:2,4|required',
          'foundation_year' => 'integer|digits:4|gte:'.Carbon::now()->subYears(10)->year.'|lte:'.Carbon::now()->year.'|required'
        ];
    }
}
