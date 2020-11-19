<?php

namespace App\Http\Requests\departments;

use Illuminate\Foundation\Http\FormRequest;

class EditDepartmentRequest extends FormRequest
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
            'editName' => "required|string",
            'editDescription' => 'sometimes'
        ];
    }

    public function messages()
    {
        return [
            'editName.required' => 'The name field is required',
            'editName.string' => 'The name field is should be a string',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'editName',
            'description' => 'editDescription'
        ];
    }
}
