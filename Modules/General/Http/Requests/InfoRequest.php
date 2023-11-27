<?php

namespace Modules\General\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;

class InfoRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'infos_status' => 'required',
			'infos_key'	=>	'unique:infos',
		];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
        	$rules[$language->locale. '.infos_desc'] = 'required';
        }

        if ($this->isMethod('PUT')) {
            $rules['infos_key'] = 'unique:infos,infos_key,'. $this->segment(4) .',infos_id';
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
