<?php

class UserTableSeeder extends Seeder {

	public function run()
	{

    User::create([
      'username'    => 'admin',
      'password'    => Hash::make('admin'),
      'hospital_id' => Hospital::first()->id
    ]); 

    User::create([
      'username'    => 'user',
      'password'    => Hash::make('user'),
      'hospital_id' => Hospital::first()->id
    ]);
    
	}

}