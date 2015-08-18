<?php
use Illuminate\Database\Seeder;
use \App\User;
class UserTableSeeder extends Seeder{

	public function run(){
	    DB::table('users')->delete();
	    User::create(array(
	        'name'     => 'Administrator',
	        'email' => 'admin@admin.com',
	        'user_type' => 1,
	        'password' => Hash::make('admin'),
	    ));
	     User::create(array(
	        'name'     => 'Amjith PS',
	        'email' => 'amjithps@gmail.com',
	        'user_type' => 2,
	        'password' => Hash::make('asasas'),
	    ));
	}

}