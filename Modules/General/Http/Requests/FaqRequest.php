<?php

namespace Modules\General\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;

class FaqRequest extends FormRequest
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
        // dd($this->request->parameters->faqs_view_page);
        // dd(request()->all());
        $rules = [
            'faqs_status'     => 'required',
        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
            $rules[$language->locale. '.faqs_question'] = 'required';
            $rules[$language->locale. '.faqs_answer'] = 'required';
        }
        if ($this->isMethod('PUT')) {
            // foreach ($languages as $language) {
              
            // }
        }

        return $rules;
    }
}
