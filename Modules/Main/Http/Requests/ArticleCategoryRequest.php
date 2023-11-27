<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;

class ArticleCategoryRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'articles_categories_status' => 'required',
            'articles_categories_position' => 'required',
  		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.articles_categories_name'] = 'required';

        }

        if ($this->isMethod('PUT')) {
            //  $rules['articles_image'] = 'nullable|mimes:'.env('images_types','png,jpg,jpeg,gif,webp');
        }

		return $rules;
	}

	/**
	 * Get the validation messages that apply to the request.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [];
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
