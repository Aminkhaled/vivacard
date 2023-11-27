<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class OfferRequest extends FormRequest
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
            'offers_image'       => 'nullable|file|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),
            'offers_position'   => 'required',
            'offers_status'     => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.offers_name'] = 'required';
        	$rules[$language->locale. '.offers_desc'] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['offers_image'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }
        return $rules;
    }
}
