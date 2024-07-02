<?php

namespace App\Http\Requests\webradio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateCategorieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('show_administration');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $current_categorie=$this->route()->parameter('categorie');

        return [
            'categorie_name'=>['string','required','min:2','max:50',Rule::unique('categories','name')->ignore($current_categorie->id)]
        ];
    }
}
