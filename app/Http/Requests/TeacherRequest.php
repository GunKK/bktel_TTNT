<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
            'email' => ['required', 'email', 'ends_with:hcmut.edu.vn'],
            'last_name' => ['required'],
            'first_name' => ['required'],
            'teacher_code' => ['required','unique:teachers'],
            'department' => ['required'],
            'faculty' => ['required'],
            'address' => ['required'],
            'phone' => ['required','min:10','max:12'],
        ];
    }
}
