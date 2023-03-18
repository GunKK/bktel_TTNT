<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'last_name' => ['required'],
            'first_name' => ['required'],
            'student_code' => ['required','unique:students'],
            'department' => ['required'],
            'faculty' => ['required'],
            'address' => ['required'],
            'phone' => ['required','min:10','max:12'],
        ];
    }

    // public function messages()
    // {
        
    // }
}
