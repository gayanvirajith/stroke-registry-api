<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OtherHeartDiseaseTableSeeder extends Seeder {

	public function run()
	{
		OtherHeartDisease::create(['name' => 'Atrial fibrillation']);
		OtherHeartDisease::create(['name' => 'Prosthetic valve']);
		OtherHeartDisease::create(['name' => 'ASD/PFO']);
		OtherHeartDisease::create(['name' => 'Heart failure']);
		OtherHeartDisease::create(['name' => 'Rheumatic valvular disease']);
		OtherHeartDisease::create(['name' => 'VSD']);
	}

}