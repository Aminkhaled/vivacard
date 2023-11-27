<?php

namespace Modules\General\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;

class ContactRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
            'contacts_mobiles' => 'nullable',
            'contacts_facebook' => 'nullable|url',
			'contacts_twitter' => 'nullable|url',
			'contacts_instagram' => 'nullable|url',
			'contacts_snapchat' => 'nullable|url',
			'contacts_whatsapp' => 'nullable|numeric',
			'contacts_email' => 'nullable|email',

		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	// $rules[$language->locale. '.contacts_address'] = 'required|max:250';
        	$rules[$language->locale. '.contacts_text'] = 'required';
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
