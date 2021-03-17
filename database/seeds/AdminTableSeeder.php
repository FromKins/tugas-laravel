<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('admins')->insert([
    		['nama' => 'Agus Santoso' ,'email' => 'iam.agussantoso@gmail.com', 'password' => app('hash')->make('12345678')]
    	]);
    }
}
