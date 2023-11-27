<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class DailyOfferRequest extends FormRequest
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
            'daily_offers_code' => 'required|regex:/^\S*$/u|unique:mysql.daily_offers,daily_offers_code',
            'stores_id'         => 'required',
            'daily_offers_url'  => 'required|url',
            'daily_offers_image'=> 'required|file|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),
            'daily_offers_price'=> 'required',
            'daily_offers_price_before_sale'   => 'required',
            'daily_offers_position'   => 'required',
            'daily_offers_status'     => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.daily_offers_name'] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['daily_offers_code'] = 'required|unique:mysql.daily_offers,daily_offers_code,'.$this->segment(4)  .',daily_offers_id';
            $rules['daily_offers_image'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }
         
        return $rules;
    }
}
