<?php

namespace App\Http\Requests\webradio;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleFormRequest extends FormRequest
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
            'article_title'=>['required','min:3','max:140','string'],
            'article_slug'=>['nullable','string','max:280','unique:articles,article_slug'],
            'isOnline'=>['nullable','boolean'],
            'categorie'=>['required','exists:categories,id'],
            'article_principal_image'=>['required','image','max:20MB','file'],
            'content'=>['required','string','min:1'],
            'blog_valide_files'=>['present'],
            'blog_files_need_drop'=>['present']
        ];
    }
}
