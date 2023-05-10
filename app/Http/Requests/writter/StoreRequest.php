<?php

namespace App\Http\Requests\writter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class StoreRequest extends FormRequest
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
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'mobile'  => ['required', 'unique:writters', 'max:13'],
            'avatar' => ['max:255'],
            'facebook' => ['max:255'],
            'twitter' => ['max:255'],
            'instagram' => ['max:255'],
            'linkedin' => ['max:255']
        ];
    }

    public function getWritter(): array
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
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'mobile.required' => 'Mobile number has already been registered',
            'mobile.unique' => 'Mobile number has already been registered',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
