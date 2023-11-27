<?php

namespace Modules\General\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\General\Models\Language;


class AdvertisementRequest extends FormRequest
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
        // dd($this->request->parameters->advertisements_view_page);
        // dd(request()->all());
        $rules = [
            'advertisements_name'       => 'required|min:2',
            'advertisements_status'     => 'required',
            'advertisements_view_page'  => 'required',
            'advertisements_url'        => 'nullable|url',
            // 'advertisements_images'	    =>	'nullable',
            // 'advertisements_images.*'	=>	'nullable|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048'),

        ];

        $languages = Language::active()->get();
        foreach ($languages as $language) {
            $rules[$language->locale. '.advertisements_web_img'] = 'required|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048');
            $rules[$language->locale. '.advertisements_phone_img'] = 'required|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048');
        }
        if ($this->isMethod('PUT')) {
            foreach ($languages as $language) {
                $rules[$language->locale. '.advertisements_web_img'] = 'nullable|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048');
                $rules[$language->locale. '.advertisements_phone_img'] = 'nullable|mimes:webp,jpg,jpeg,png|max:'.env('maxFileSize','2048');
            }
        }

        return $rules;
    }
}
