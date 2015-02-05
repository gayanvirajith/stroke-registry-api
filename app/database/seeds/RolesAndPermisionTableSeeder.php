<?php

class RolesAndPermisionTableSeeder extends Seeder {

  public function run()
  {

    // Create roles

    $admin = new Role();
    $admin->name = 'Admin';
    $admin->save();
  
    $hAdmin = new Role();
    $hAdmin->name = 'Hospital Admin';
    $hAdmin->save();
  
    $user = new Role();
    $user->name = 'User';
    $user->save();

    // Create permisions

    $managePatientProfile = new Permission();
    $managePatientProfile->name = 'manage_patient_profile';
    $managePatientProfile->display_name = 'Manage patient profile';
    $managePatientProfile->save();
  
    $generatePatientProfile = new Permission();
    $generatePatientProfile->name = 'generate_new_patient_profile';
    $generatePatientProfile->display_name = 'Generate new patient profile';
    $generatePatientProfile->save();

    $manageUsers = new Permission();
    $manageUsers->name = 'manage_users';
    $manageUsers->display_name = 'Manage users';
    $manageUsers->save();

    // Attach permission to roles

    $user->attachPermission($managePatientProfile);
    $user->attachPermission($generatePatientProfile);

    $hAdmin->attachPermission($managePatientProfile);
    $hAdmin->attachPermission($generatePatientProfile);

    $hAdmin->attachPermission($managePatientProfile);
    $hAdmin->attachPermission($generatePatientProfile);

    $admin->attachPermission($managePatientProfile);
    $admin->attachPermission($generatePatientProfile);
    $admin->attachPermission($manageUsers);


    $adminRole = DB::table('roles')->where('name', '=', 'Admin')->pluck('id');
    $hAdminRole = DB::table('roles')->where('name', '=', 'Hospital Admin')->pluck('id');
    $userRole = DB::table('roles')->where('name', '=', 'User')->pluck('id');

    $user1 = User::where('username','=','admin')->first();
    $user1->roles()->attach($adminRole);
    
  }

}