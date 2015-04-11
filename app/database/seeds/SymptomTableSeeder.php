<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class SymptomTableSeeder extends Seeder {

	public function run()
	{
		Symptom::create(['name' => 'Weakness']);
		Symptom::create(['name' => 'Speech disturbance']);
		Symptom::create(['name' => 'Sensory symptoms']);
		Symptom::create(['name' => 'Dysphagia']);
		Symptom::create(['name' => 'Visual disturbance']);
		Symptom::create(['name' => 'Seizure']);
		Symptom::create(['name' => 'Headache']);
		Symptom::create(['name' => 'Sphincter Involvement']);
	}

}