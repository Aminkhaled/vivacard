<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
class CustomerRequest extends FormRequest
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
        $phone_digits = env("phone_digits",9) - 1 ;

        $rules = [
            'customers_name'      => 'required',
            'customers_email'     => 'nullable|customers_email|unique:customers,email',
            'customers_birthdate' => 'required',
            'password'  => 'required|min:6|confirmed',
            'customers_phone'     => 'required|numeric|digits:'.env("phone_digits",9).'|regex:/^[1-9]{1}[0-9]{'.$phone_digits.'}/|unique:customers,customers_phone',
        ];

        if ($this->isMethod('PUT')) {
            $rules['customers_email'] = 'nullable|email|unique:customers,customers_email,'. $this->segment(4) .',customers_id';
            $rules['customers_phone'] = 'required|numeric|digits:'.env("phone_digits",9).'|regex:/^[1-9]{1}[0-9]{'.$phone_digits.'}/|unique:customers,customers_phone,'. $this->segment(4) .',customers_id';
            $rules['password'] = 'confirmed';
        }

        return $rules;
    }
}
