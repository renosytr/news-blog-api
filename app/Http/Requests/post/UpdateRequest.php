<?php

namespace App\Http\Requests\post;

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
            'category_id' => ['required'],
            'title' => ['required'],
            'post_content' => ['required'],
            'summary' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category of the post is required',
            'title.required' => 'CategoTitlery of the post is required',
            'content.required' => 'Content of the post is required',
            'summary.required' => 'summary of the post is required',

        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
