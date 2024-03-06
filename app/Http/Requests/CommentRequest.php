<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentRequest extends FormRequest
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
            'user_name' => 'required|string',
            'email' => 'required|email',
            'home_page' => 'nullable|url',
            'file' => 'nullable|image',
            'text' => 'required|string',
            'parent_comment_id' => 'nullable|exists:comments,id',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->all();

        $response = response()->json(['errors' => $errors], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);

    }

    public function messages(): array
    {
        return [
            'parent_comment_id.exists' => 'The parent comment does not exist.',
        ];
    }
}
