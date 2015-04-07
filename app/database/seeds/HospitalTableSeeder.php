<?php

class HospitalTableSeeder extends Seeder {

  public function run()
  {

    Hospital::create(['name' => 'National Hospital of Sri Lanka']);
    Hospital::create(['name' => 'Badulla Provincial General Hospital']);
    Hospital::create(['name' => 'Jaffna Teaching Hospital']);
    Hospital::create(['name' => 'Matara District General Hospital']);
    Hospital::create(['name' => 'Ratnapura Provincial General Hospital']);
  }

}