<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\General\Models\Language;
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'locale' => 'en',
            'dir' => 'ltr'
        ]);

        Language::create([
            'name' => 'عربي',
            'locale' => 'ar',
            'dir' => 'rtl'
        ]);
    }
}
