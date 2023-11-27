<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'cities_status' => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.cities_name'] = 'required';
        }


        return $rules;
    }
}
