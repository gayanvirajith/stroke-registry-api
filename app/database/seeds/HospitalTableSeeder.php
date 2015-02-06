<?php

class HospitalTableSeeder extends Seeder {

  public function run()
  {

    Hospital::create([
      'name' => 'Colombo National Hospital',
    ]); 
  }

}