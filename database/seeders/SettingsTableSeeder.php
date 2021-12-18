<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            ['key' => 'dashboard_name_ar', 'value' => 'لوحة تحكم موقع وتطبيق مزادات', 'created_at' => now(), ],
            ['key' => 'dashboard_name_en', 'value' => 'Mazadat Dashboard', 'created_at' => now(), ],
            ['key' => 'project_name_ar', 'value' => 'موقع وتطبيق مزادات', 'created_at' => now(), ],
            ['key' => 'project_name_en', 'value' => 'Mazadat Website & App', 'created_at' => now(), ],
            ['key' => 'app_description_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء', 'created_at' => now(), ],
            ['key' => 'app_description_en', 'value' => 'موقع وتطبيق مزاداdsssvfsvgdfghت', 'created_at' => now(), ],

            ['key' => 'app_lang', 'value' => 'ar', 'created_at' => now(), ],
            ['key' => 'mobile', 'value' => '966547855230', 'created_at' => now(), ],
            ['key' => 'email', 'value' => 'info@mazadat.com', 'created_at' => now(), ],

            //social
            ['key' => 'facebook_url', 'value' => 'https://www.facebook.com/', 'created_at' => now(), ],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/', 'created_at' => now(), ],
            ['key' => 'youtube_url', 'value' => 'https://www.youtube.com/', 'created_at' => now(), ],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/', 'created_at' => now(), ],
            ['key' => 'whatsapp_phone', 'value' => '966123456789', 'created_at' => now(), ],

            //for auctions
            ['key' => 'min_duration_of_auction', 'value' => '5 hours', 'created_at' => now(), ],
            ['key' => 'min_time_unit', 'value' => 'hour', 'created_at' => now(), ],
            ['key' => 'max_duration_of_auction', 'value' => '10 days', 'created_at' => now(), ],
            ['key' => 'max_time_unit', 'value' => 'day', 'created_at' => now(), ],



            ['key' => 'sms_type', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_username', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_username', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_password', 'value' => '', 'created_at' => now(), ],
            ['key' => 'sms_sender', 'value' => '', 'created_at' => now(), ],

            ['key' => 'auto_active_client', 'value' => 'false', 'created_at' => now(), ], // علشان المستخدمين كلهم يتعملهم actvie على طول
            ['key' => 'distance_search_for_stores', 'value' => '100', 'created_at' => now(), ],
            ['key' => 'google_map_key', 'value' => 'AIzaSyDdCP49XcVxRLuY-4CYtxHXxnqucDvQLE8', 'created_at' => now(), ],
            // general
            ['key' => 'about_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', 'created_at' => now(), ],
            ['key' => 'about_en', 'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', 'created_at' => now(), ],
            ['key' => 'conditions_terms_ar', 'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء.', 'created_at' => now(), ],
            ['key' => 'conditions_terms_en', 'value' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable.', 'created_at' => now(), ],
        ]);

    }
}
