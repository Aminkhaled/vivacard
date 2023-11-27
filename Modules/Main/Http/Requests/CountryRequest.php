<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class CountryRequest extends FormRequest
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
            'countries_status' => 'required',
            'countries_image'      => 'required|file|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),

        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.countries_name'] = 'required';
        }
        if ($this->isMethod('PUT')) {
            $rules['countries_image'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }

        return $rules;
    }
}
