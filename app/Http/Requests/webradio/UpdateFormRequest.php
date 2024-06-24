<?php

namespace App\Http\Requests\webradio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'programmes.*.date' => 'Date',
            'programmes.*.hour'=>'Hour'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dateOfDay=now('africa/porto-novo')->format('Y-m-d');

        return [

            'communique_email'=>['nullable','email','string'],

            'communique_tel'=>['required','string','min:4'],

            'programmes.*.date'=>['date','required',"after_or_equal:{$dateOfDay}"],

            'programmes.*.hour'=>['required','string',Rule::in(['6:45:00','13:20:00','13:45:00','18:45:00','19:20:00','19:45:00','21:45:00'])],

            'communique_files'=>['required','array','min:1','max:2'],
            'communique_files.*'=>['string'],

            'communique_details'=>['string','min:4','max:300','required']
        ];
    }
}
