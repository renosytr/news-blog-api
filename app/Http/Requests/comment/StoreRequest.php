<?php

namespace App\Http\Requests\comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

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
            'slug' => ['required'],
            'reader_id' => ['required'],
            'comment_content' => ['required']
        ];
    }

    public function getComment(): array
    {
        return [
            'slug' => $this->slug,
            'reader_id' => $this->reader_id,
            'comment_content' => $this->comment_content
        ];
    }

    public function messages(): array
    {
        return [
            'slug.required' => 'Post slug is required',
            'reader_id.required' => 'Reader ID is required',
            'comment_content.required' => 'Comment is required',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();
        throw new HttpResponseException(response()->json(['status' => Response::HTTP_UNPROCESSABLE_ENTITY, 'message' => $errors], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
