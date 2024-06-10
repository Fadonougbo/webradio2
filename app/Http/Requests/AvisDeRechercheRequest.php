<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvisDeRechercheRequest extends FormRequest
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
            'programme.*.date' => 'Date',
            'programme.*.periode'=>'Hour'
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

            'adr_email'=>['required','email','string'],

            'adr_tel'=>['required','numeric','min_digits:8','max_digits:8','numeric'],

            'programme.*.date'=>['date','required',"after_or_equal:{$dateOfDay}"],

            'programme.*.periode'=>['required','string',Rule::in(['6:45:00','13:20:00','13:40:00','18:45:00','19:20:00','19:45:00','21:45:00'])],

            'adr_file'=>['required'],

            'adr_detail'=>['nullable']
        ];
    }
}
