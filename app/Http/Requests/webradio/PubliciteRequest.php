<?php

namespace App\Http\Requests\webradio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PubliciteRequest extends FormRequest
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

        $dateOfDay=now('africa/porto-novo')->format('Y-m-d');

        return [
            'pub_user_name'=>['required','string'],

            'pub_email'=>['required','email','string'],

            'pub_tel'=>['required','numeric','min_digits:8','max_digits:8','numeric'],

            'pub_nb_diffusion'=>['required','min:1','numeric'],

            'pub_date'=>['date','required',"after_or_equal:{$dateOfDay}"],

            'pub_periode'=>['required','string',Rule::in(['6:45','13:20','13:40','18:45','19:20','19:45','21:45'])],

            'pub_file'=>['required'],

            'pub_detail'=>['nullable']
        ];
    }
}
