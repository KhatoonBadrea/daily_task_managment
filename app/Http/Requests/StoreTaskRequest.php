<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function prepareForValidation()
    {
        $dueDate = $this->input('due_date');

        if ($dueDate) {
            try {
                $dueDate = Carbon::createFromFormat('d-m-Y H:i', $dueDate);
            } catch (\Exception $e) {
                throw new HttpResponseException(response()->json([
                    'status' => 'error',
                    'message' => 'Invalid due_date format.',
                    'errors' => ['due_date' => 'The due_date must match the format d-m-Y H:i.']
                ]));
            }
        }




        $this->merge([
            'due_date' => $dueDate ? $dueDate->format('d-m-Y H:i') : null,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'status' => 'nullable|string|in:Pending,Completed',
            'due_date' => 'nullable|date|after:now',
            'user_id' => 'required|integer'

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
