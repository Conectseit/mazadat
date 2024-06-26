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

    'accepted' => 'يجب قبول :attribute.',
    'active_url' => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after' => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ :date.',
    'after_or_equal' => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha' => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash' => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num' => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array' => 'يجب أن يكون :attribute ًمصفوفة.',
    'before' => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between' => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array' => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean' => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed' => ' التأكيد غير مُطابق  :attribute.',
    'date' => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals' => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format' => 'لا يتوافق :attribute مع الشكل :format.',
    'different' => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits' => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between' => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions' => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'للحقل :attribute قيمة مُكرّرة.',
    'email' => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح .',
    'exists' => 'القيمة المحددة :attribute غير موجودة.',
    'file' => 'الـ :attribute يجب أن يكون ملفا.',
    'filled' => ':attribute إجباري.',
    'gt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image' => 'يجب أن يكون :attribute صورةً.',
    'in' => ':attribute غير موجود.',
    'in_array' => ':attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4' => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6' => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json' => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt' => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file' => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file' => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string' => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array' => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => 'يجب أن يكون ملفًا من نوع : :values.',
    'min' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file' => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array' => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in' => ':attribute موجود.',
    'not_regex' => 'صيغة :attribute غير صحيحة.',
    'numeric' => 'يجب على :attribute أن يكون رقمًا.',
    'present' => 'يجب تقديم :attribute.',
    'regex' => 'صيغة :attribute .غير صحيحة.',
    'required' => ':attribute مطلوب.',

    'activation code'         	=> ' كودالتفعيل',

    'sometimes' => ':attribute مطلوب.',
    'required_if' => ':attribute مطلوب في حالة إذا كان :other هو :value.',
    'required_unless' => ':attribute مطلوب في حالة اذا لم يكن :other هو :values.',
    'required_with' => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all' => ':attribute مطلوب إذا توفّر :values.',
    'required_without' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same' => 'يجب أن يتطابق :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file' => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string' => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array' => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with' => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string' => 'يجب أن يكون :attribute نصًا.',
    'timezone' => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique' => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل في تحميل الـ :attribute.',
    'url' => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid' => ':attribute يجب أن يكون بصيغة UUID سليمة.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],

        'g-recaptcha-response' => [
            'required' => 'Please verify that you are not a robot.',
            'captcha' => 'Captcha error! try again later or contact site admin.',
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
        'name' => 'الاسم',
        'name_ar' => 'الاسم العربي',
        'name_en' => 'الاسم الانجليزي',
        'description_ar' => 'الوصف بالعربية ',
        'description_en' => 'الوصف بالانجليزية',
        'name_of_the_licensor' => 'إسم المُرخْص',
        'license_number' => 'رقم ترخيص الإعلان',
        'brokerage_license_number' => 'رقم ترخيص الوساطه و التسويق',
        'userType' => 'نوع الحساب ',
        'person' => 'شخصي',
        'company' => 'شركات',
        'user_name' => 'اسم المُستخدم',
        'email' => 'البريد الالكتروني',
        'P_O_Box' => 'الرقم البريدي',
        'first_name' => 'الاسم الأول',
        'last_name' => 'الاسم الاخير',
        'password' => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city' => 'المدينة',
        'country' => 'الدولة',
        'address' => 'عنوان السكن',
        'phone' => 'الهاتف',
        'mobile' => 'الجوال',
        'activation_code'   => ' كودالتفعيل',
        'age' => 'العمر',
        'sex' => 'الجنس',
        'gender' => 'النوع',
        'day' => 'اليوم',
        'month' => 'الشهر',
        'year' => 'السنة',
        'hour' => 'ساعة',
        'minute' => 'دقيقة',
        'second' => 'ثانية',
        'title' => 'العنوان',
        'content' => 'المُحتوى',
        'description' => 'الوصف',
        'excerpt' => 'المُلخص',
        'date' => 'التاريخ',
        'time' => 'الوقت',
        'available' => 'مُتاح',
        'size' => 'الحجم',

        'full_name' => 'الإسم بالكامل',
        'passport_image' => 'صورة الهوية او جواز السفر',
        'city_id' => 'المدينة',
        'nationality_id' => 'الجنسية',
        'banned' => 'الحظر',
        'ban_reason' => 'سبب الحظر',
        'start_date' => 'وقت ابتداء المزاد',
        'end_date' => 'وقت انتهاء المزاد',
        'images.*' => 'صور المزاد',
        'option_ids' => 'التصنيفات الاجبارية للمزاد',

        'passport_expiry_date'         	=> ' تاريخ انتهاء جواز السفر',
        'is_company'         	=> 'النوع',
        'company'         	=> ' شركة',
        'commercial_register_image'         	=> 'صورة السجل التجاري',
        'latitude'         	=> ' الموقع',
        'longitude'         	=> ' الموقع',
        'block_num'         	=> ' رقم المبني',
        'country_id'         	=> ' كود الدولة',
        'seller_id'         	=> ' صاحب المزاد',
        'category_id'         	=> 'القسم ',
        'inspection_report_images'         	=> 'ملفات تقارير الفحص ',
        'images'            	=> 'صورالمزاد',
        'file_name_ids'         	=> 'ملفات تقارير الفحص',
        'files.*.image'         	=> 'ملفات تقارير الفحص',
        'option_details_id'         	=> 'التصنيفات الاجبارية للمزاد',
        'required_option_details_id'    => 'التصنيفات الاجبارية للمزاد',



        'start_auction_price' => ' السعر الابتدائي للمزاد ',
        'value_of_increment' => 'قيمة المزايدة في كل مرة',
        'delivery_charge' => 'قيمة رسوم الشحن الابتدائية',
        'auction_terms_ar' => 'الشروط والاحكام بالعربي',
        'auction_terms_en' => 'الشروط والاحكام بالانجليزي',
        'inspection_report_image' => 'صورة تقرير الفحص',
        'company_authorization_image' => 'صورة التفويض من المؤسسة',
//        'g-recaptcha-response' => 'Please verify that you are not a robot.',
        'category_id' => 'إختيار القسم',
        'city_id' => 'إختيار المدينة',
        'district_ar' => 'الحي بالعربي',
        'district_en' => 'الحي بالإنجليزي',
        'street_ar' => 'الشارع بالعربي',
        'street_en' => 'الشارع بالإنجليزي',
        'property_facade_ar' => 'واجهة العقار بالعربي',
        'property_facade_en' => 'واجهة العقار بالإنجليزي',
        'space' => 'المساحة',
        'purpose' => 'إختيار الغرض',
        'price_per_meter_of_land' => 'سعر المتر (للأرض) ',
        'unit_price' => 'سعر الوحة',
        'property_type_ar' => 'نوع العقار بالعربي',
        'property_type_en' => 'نوع العقار بالإنجليزي',
        'age_of_the_property' => 'عمر العقار',
        'services_related_ar' => 'الخدمات المتعلقة بالعقار بالعربي',
        'services_related_en' => 'الخدمات المتعلقة بالعقار بالإنجليزي',
        'purpose_of_the_advertisement' => 'الغرض من الإعلان',




    ],
];
