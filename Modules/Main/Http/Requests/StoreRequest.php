<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class StoreRequest extends FormRequest
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
            'stores_code'       => 'required|regex:/^\S*$/u|unique:mysql.stores,stores_code',
            'stores_link'       => 'required|url',
            'stores_logo'       => 'required|file|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),
            'stores_position'   => 'required',
            'stores_status'     => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.stores_name'] = 'required';
        	$rules[$language->locale. '.stores_desc'] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['stores_code'] = 'required|regex:/^\S*$/u|unique:mysql.stores,stores_code,'.$this->segment(4)  .',stores_id';
            $rules['stores_logo'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }
         
        return $rules;
    }
}
