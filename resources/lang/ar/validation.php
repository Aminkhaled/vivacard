<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق لحقل :attribute.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'لحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'exists'               => 'القيمة المحددة :attribute غير موجودة.',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف ل :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص ل :attribute أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورةً.',
    'in'                   => ':attribute غير موجود.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => ':attribute موجود.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'present'              => 'يجب تقديم :attribute.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'required'             => ':attribute مطلوب',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => ':attribute مستخدم من قبل',
    'uploaded'             => 'فشل في تحميل الـ :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'                 => ':attribute يجب أن يكون بصيغة UUID سليمة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */
    'contact_us_phone_regex'   => 'يجب أن يحتوي رقم الجوال على ٩ رقمًا/أرقام وان لا يبدأ بصفر.',
    'SpaceNotAllowedForCode'    => 'غير مسموح بالمسافات في كود التصنيف',
    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'الاسم',
        'username'              => 'اسم المُستخدم',
        'email'                 => 'البريد الالكتروني',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'country'               => 'الدولة',
        'phone'                 => 'الجوال',
        'mobile'                => 'الجوال',
        'gender'                => 'النوع',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'images'                =>  'الصور',

        /**
         * Admin
         */
        'admins_position'       => 'الترتيب',
        'admins_status'         => 'الحالة',
        'roles'                 => 'الادوار',

        /**
         * Cities
         */
        'en.cities_name'        => 'عنوان المدينة الانجليزى',
        'ar.cities_name'        => 'عنوان المدينة العربى',
        'cities_position'       => 'ترتيب المدينة',
        'cities_status'         => 'حالة المدينة',
        'cities_code'           => 'كود المدينة',

        /**
         * Countries
         */
        'countries_img'             =>  'صورة الدولة',
        'en.countries_name'         => 'عنوان الدولة الانجليزى',
        'ar.countries_name'         => 'عنوان الدولة العربى',
        'countries_position'        => 'ترتيب الدولة',
        'countries_status'          => 'حالة الدولة',

        /**
         * Advertisement
         */
        'advertisements_img'        =>  'صورة الاعلان',
        'advertisements_name'       => 'عنوان الاعلان',
        'advertisements_position'   => 'ترتيب الاعلان',
        'advertisements_status'     => 'حالة الاعلان',
        'ar.advertisements_text'    => 'نص الاعلان بالعربي',
        'en.advertisements_text'    => 'نص الاعلان بالانجليزي',
        'advertisements_mobile_img' => 'صورة الجوال',
        'ar.advertisements_mobile_img'    => 'صورة الجوال بالعربي',
        'en.advertisements_mobile_img'    => 'صورة الجوال بالانجليزي',
        'ar.advertisements_img'    => 'صورة الاعلان بالعربي',
        'en.advertisements_img'    => 'صورة الاعلان بالانجليزي',

        /**
         * Categories
         */
        'categories_img'            =>  'صورة التصنيف',
        'en.categories_name'        => 'النص الانجليزى',
        'ar.categories_name'        => 'النص العربى',
        'categories_position'       => 'ترتيب التصنيف',
        'categories_status'         => 'حالة التصنيف',
        'en.categories_title'       => 'العنوان الانجليزى',
        'ar.categories_title'       => 'العنوان العربى',
        'types'                     => 'الانواع',

        /**
         * MetaTag
         */
        'en.metatags_title'         => 'عنوان التهيئة الانجليزى',
        'ar.metatags_title'         => 'عنوان التهيئة العربى',
        'en.metatags_desc'          => 'وصف التهيئة الانجليزى',
        'ar.metatags_desc'          => 'وصف التهيئة العربى',
        'metatags_position'         => 'الترتيب',
        'metatags_page'             => 'اسم الصفحة',
        'metatags_status'           => 'الحالة',


        /**
         * Infos
         */
        'en.infos_value'            => 'النص',
        'ar.infos_value'            => 'النص',
        'infos_key'                 => 'العنوان',
        'infos_title'               => 'العنوان',
        'en.infos_title'            => 'العنوان بالانجليزية',
        'ar.infos_title'            => 'العنوان بالعربية',
        'infos_position'            => 'الترتيب',
        'infos_status'              => 'الحالة',

        /**
         * Role
         */
        'permissions'               => 'الصلاحيات',


        /**
         * Contact Us
         */
        'contact_us_name'           =>  'الاسم',
        'contact_us_email'          =>  'البريد',
        'contact_us_phone'          =>  'الجوال',
        'contact_us_text'           =>  'الرسالة',
        'contact_us_message'        =>  'الرسالة',

        /**
        * articles categories
        */
        'ar.articles_categories_name'  => ' اسم تصنيف المقال بالعربي',
        'en.articles_categories_name'  => ' اسم تصنيف المقال بالانجليزي',

         /**
        * articles
        */
        'articles_date'         => '  تاريخ المقالة',
        'articles_categories_id'=> ' تصنيف المقالة ',
        'articles_image'        => ' صورة المقالة ',
        'ar.articles_title'     => ' عنوان المقالة بالعربي ',
        'en.articles_title'     => ' عنوان المقالة بالانجليزي ',
        'ar.articles_desc'      => '  نص المقالة بالعربي',
        'en.articles_desc'      => ' نص المقالة بالانجليزي ',

        /**
        * categories
        */
        'categories_code'        => ' كود التصنيف',
        'categories_id'        => ' كود التصنيف',
        'categories_parent_id'   => ' التصنيف',


    ],
];


