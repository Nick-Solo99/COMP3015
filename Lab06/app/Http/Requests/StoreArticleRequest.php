<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string|max:64',
            'url' => 'required|url|max:1024',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The Title field is required.',
            'url.required' => 'The URL field is required.',
            'url.url' => 'The URL must be a valid URL.',
        ];
    }
}
