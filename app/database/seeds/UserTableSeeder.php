<?php

class UserTableSeeder extends Seeder {

	public function run()
	{

    User::create([
      'username' => 'admin',
      'password' => Hash::make('admin')
    ]); 

    User::create([
      'username' => 'user',
      'password' => Hash::make('user')
    ]);
	}

}