<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'facility_id' => '63',
	        'username' => 'admin_doh1',
	        'password' => Hash::make('s3cur1ty'),
	        'level' => 'superadmin',
	        'fname' => 'Admin',
	        'mname' => 'RO XII',
	        'lname' => 'DOH',
	        'title' => '',
	        'contact' => '',
	        'email' => 'helpdeskro12@gmail.com',
	        'accrediation_no' => '',
	        'accrediation_validity' => '',
	        'license_no' => '',
	        'prefix' => '',
	        'picture' => '',
	        'designation' => 'CP II',
	        'status' => '',
	        'last_login' => '',
	        'login_status' => '',
	        'void' => '0'
        ]);
    }
}
