<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class UserEmailRequest extends FormRequest
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
            'email' => ['required'],
        ];
    }

    public function getEmail(): array
    {
        return [
            'email'=> $this->email,
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
