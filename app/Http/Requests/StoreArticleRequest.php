<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return $this->user()->hasRole('admin'); }


    public function rules(): array
    {
        return [
            'title' => ['required','string','max:180'],
            'short_des' => ['nullable','string','max:300'],
            'content' => ['required','string','min:20'],
            'image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
            'is_published' => ['nullable','boolean'],
            'meta_title' => ['nullable','string','max:180'],
            'meta_description' => ['nullable','string','max:180'],
        ];
    }
}
