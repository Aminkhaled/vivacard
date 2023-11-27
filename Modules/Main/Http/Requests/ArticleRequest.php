<?php

namespace Modules\Main\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;

class ArticleRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'articles_status' => 'required',
			'articles_date' => 'required|date',
			'articles_categories_id' => 'required',
            'articles_image' => 'nullable',
            'articles_position' => 'required',
            'articles_images'	=>	'nullable',
            'articles_images.*'	=>	'nullable|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048'),
			// 'articles_image' => 'required|mimes:'.env('images_types','png,jpg,jpeg,gif,webp'),
  		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.articles_title'] = 'required';
        	// $rules[$language->locale. '.articles_slug'] = 'required';
        	$rules[$language->locale. '.articles_desc'] = 'required';
        }

        if ($this->isMethod('PUT')) {
             $rules['articles_image'] = 'nullable';
             $rules['articles_images'] = 'nullable';
             $rules['articles_images.*'] 	=	'nullable|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048');
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
