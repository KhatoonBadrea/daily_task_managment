<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'due_date' => 'nullable|date',
            'status' => 'nullable|in:Pending,Completed',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'title',
            'description' => 'description',
            'due_date' => 'due_date',
            'status' => 'status',


        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute is required',
            'date' => 'The :attribute must be a valid date',
            'status.in' => 'The status must be one of the following values:Pending,Completed',
        ];
    }
}


