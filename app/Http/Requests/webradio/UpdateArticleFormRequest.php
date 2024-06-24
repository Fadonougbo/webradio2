<?php

namespace App\Http\Requests\webradio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class UpdateArticleFormRequest extends FormRequest
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
            'article_title'=>['required','min:3','max:330','string'],

            'isOnline'=>['nullable','boolean'],

            'categorie'=>['required','exists:categories,id'],

            'article_principal_image'=>['nullable','image',File::image()->max('19mb')],

            'content'=>['required','string','min:1'],

            'blog_valide_files'=>['present'],

            'blog_files_need_drop'=>['present']

        ];
    }
}
