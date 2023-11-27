<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\General\Models\Info;
use Modules\General\Models\InfoTranslation;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $infos = [
            [
                'infos_key' => 'about',
                'infos_status' => '1',
                'infos_position' => '1',
                'en' => ['infos_title' => 'about text', 'infos_desc' => 'about desc'],
                'ar' => ['infos_title' => 'عنا', 'infos_desc' => 'نص عنا'],
            ],
            [
                'infos_key' => 'policy',
                'infos_status' => '1',
                'infos_position' => '1',
                'en' => ['infos_title' => 'policy text', 'infos_desc' => 'policy desc'],
                'ar' => ['infos_title' => 'سياسةالخصوصية', 'infos_desc' => 'نص سياسة الخصوصية'],
            ],
            [
                'infos_key' => 'terms',
                'infos_status' => '1',
                'infos_position' => '1',
                'en' => ['infos_title' => 'terms text', 'infos_desc' => 'terms desc'],
                'ar' => ['infos_title' => 'الشروط والأحكام', 'infos_desc' => 'نص الشروط والأحكام'],
            ]
        ];
        foreach ($infos as $info) {
            Info::create($info);
        }

    }
}
