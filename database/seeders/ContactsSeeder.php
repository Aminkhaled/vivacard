<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\General\Models\Contact;
use Modules\General\Models\ContactTranslation;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $contact = Contact::create([
            'contacts_mobiles'          => '123654789',
            'contacts_facebook'         =>'https://facebook.com',
            'contacts_twitter'          =>'https://twitter.com',
            'contacts_instagram'        =>'https://instagram.com',
            'contacts_snapchat'         =>'https://snapchat.com',
            'contacts_youtube'          =>'https://toutube.com',
            'contacts_whatsapp'         =>'+971423654789',
            'contacts_email'            =>'noreply@email.com',
        ]);
        ContactTranslation::create([
            'contacts_id' => $contact->contacts_id,
            'locale' => 'ar',
            'contacts_text' => 'نص تواصل معنا',
            'contacts_address' => 'عنوان التواصل',
        ]);
        ContactTranslation::create([
            'contacts_id' => $contact->contacts_id,
            'locale' => 'en',
            'contacts_text' => 'contacts text',
            'contacts_address' => 'contacts address',
        ]);


    }
}
