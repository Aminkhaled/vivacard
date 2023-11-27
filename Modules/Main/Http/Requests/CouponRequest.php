<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class CouponRequest extends FormRequest
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
            // 'coupons_code'       => 'required|regex:/^\S*$/u|unique:mysql.coupons,coupons_code',
            'coupons_code'       => 'required',
            'stores_id'          => 'required',
            'offers_id'          => 'required',
            'coupons_image'      => 'required|file|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),
            'coupons_is_special'=> 'required',
            'coupons_available'  => 'required',
            'coupons_position'   => 'required',
            'coupons_status'     => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.coupons_name'] = 'required';
        }

        if ($this->isMethod('PUT')) {
            // $rules['coupons_code'] = 'required|unique:mysql.coupons,coupons_code,'.$this->segment(4)  .',coupons_id';
            $rules['coupons_code'] = 'required';
            $rules['coupons_image'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }
        
        return $rules;
    }
}
