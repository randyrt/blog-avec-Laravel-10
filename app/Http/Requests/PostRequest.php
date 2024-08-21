<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->slug ?? $this->title),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        return [
            'title' => ['required', 'string', 'between:3,100'],
            'slug' => ['required', 'string', 'between:3,100', Rule::unique('posts')->ignore($this->post)],
            'content' => ['required', 'string', 'min:10'],
            'thumbnail' => [Rule::requiredIf($request->isMethod('post')), 'image'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tag_ids' => ['array', 'exists:tags,id']
        ];
    }
}
