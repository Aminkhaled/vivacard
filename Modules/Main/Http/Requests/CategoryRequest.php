<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;
// use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		// dd($request->categories_code);
		$rules = [
            'categories_position' => 'required|numeric',
			'categories_status' => 'required',
			'categories_code' => 'required|regex:/^\S*$/u|unique:mysql.categories,categories_code',
		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.categories_name'] = 'required|max:250';
        }
		// dd($this->segment(4) ) ;
        if ($this->isMethod('PUT')) {
			$rules['categories_code'] = 'required|unique:mysql.categories,categories_code,'.$this->segment(4)  .',categories_id';
            //$rules['categories_img'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }
		// dd ($rules);
		return $rules;
	}

	/**
	 * Get the validation messages that apply to the request.
	 *
	 * @return array
	 */
	public function messages()
	{
 		return [
			'categories_code.regex' => __('validation.SpaceNotAllowedForCode')
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}
}
