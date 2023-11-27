<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB ;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('mysql')->table('admins')->insert([
            'name' => 'primoCoupon',
            'email' => 'admin@primocoupon.com',
            'password' => bcrypt('primoCoupon'),
            'admins_status' => '1',
            'admins_position' => 1,
        ]);

        DB::connection('mysql')->table('admins')->insert([
            'name' => 'AdminPrimo',
            'email' => 'test@primocoupon.com',
            'password' => bcrypt('AdminPrimo'),
            'admins_status' => '1',
            'admins_position' => 1,
        ]);

    }
}
