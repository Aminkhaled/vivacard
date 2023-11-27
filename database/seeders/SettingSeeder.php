<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\General\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'settings_key' => 'website_status',
            'settings_value' => '1',
        ]);

        Setting::create([
            'settings_key' => 'website_lang',
            'settings_value' => 'en',
        ]);


    }
}
