<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'is_writter' => ['required', 'boolean'],
            'is_reader' => ['required', 'boolean'],
            'is_admin' => ['required', 'boolean'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'mobile'  => ['required', 'unique:writters', 'unique:readers', 'max:13'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function getUserData(): array
    {
        return [
            'first_name'=> $this->first_name,
            'last_name' => $this->last_name,
            'avatar' => $this->avatar,
            'summary' => $this->summary,
            'mobile' => $this->mobile,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->intagram,
            'linkedin' => $this->linkedin,
            'is_newsletter' => $this->is_newsletter,
        ];
    }
    
    public function messages(): array
    {
        return [
            'is_writter.required' => 'Please determine whether the user is a writter',
            'is_reader.required' => 'Please determine whether the user is a reader',
            'is_admin.required' => 'Please determine whether the user is an admin',
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'mobile.required' => 'Mobile number is required',
            'mobile.unique' => 'Mobile number has already been registered',
            'name.required' => 'Email is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email has already been registered',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
