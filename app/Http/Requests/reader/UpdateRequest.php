<?php

namespace App\Http\Requests\reader;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends FormRequest
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
            'first_name' => ['max:255'],
            'last_name' => ['max:255'],
            'mobile'  => ['unique:writters', 'max:13'],
            'avatar' => ['max:255'],
            'facebook' => ['max:255'],
            'twitter' => ['max:255'],
            'instagram' => ['max:255'],
            'linkedin' => ['max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'mobile.unique' => 'Mobile number has already been registered',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
