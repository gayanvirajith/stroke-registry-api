<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->call('HospitalTableSeeder');
		$this->call('SymptomTableSeeder');
		$this->call('OtherHeartDiseaseTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('RolesAndPermisionTableSeeder');
	}

}
