<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* 
 * Only users with roles that have the 'generate_new_patient_profile' 
 * permission will be able to access patient/generate-profile route.
 */
Route::when('patient/generate-profile', 'generate_new_patient_profile');


/**
 * Custom validation hooks
 */

Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new ExtendedValidator($translator, $data, $rules, $messages);
});

// Patient profile
Validator::extend('province', 'PatientValidation@provinceCheck');
Validator::extend('marital', 'PatientValidation@maritialStatusCheck');
Validator::extend('education', 'PatientValidation@educationCheck');
Validator::extend('employment', 'PatientValidation@employmentCheck');
Validator::extend('levelOfIndependence', 'PatientValidation@levelOfIndependenceCheck');
Validator::extend('livingArrangement', 'PatientValidation@livingArrangementCheck');
Validator::extend('ethinicity', 'PatientValidation@ethinicityCheck');
Validator::extend('postpartum', 'PatientValidation@postpartumCheck');
Validator::extend('dexterity', 'PatientValidation@dexterityCheck');

// Event onset
Validator::extend('symptoms', 'EventOnsetValidation@symptomsCheck');
Validator::extend('presentationTo', 'EventOnsetValidation@presentationCheck');
Validator::extend('transportOption', 'EventOnsetValidation@transportOptionCheck');
Validator::extend('oxfordshireClassification', 
  'EventOnsetValidation@oxfordshireCommunityClassificationOptionsCheck');
Validator::extend('sideOfSymptoms', 'EventOnsetValidation@sideOfSymptomsOptionsCheck');

/*
 * GET Routes
 */

// Root route (Home page)

Route::get('/', 
  array(
    'before' => 'auth',
    'uses' => 'HomeController@showWelcome', 
    'as' => 'home' 
));

// Generate patient profile

Route::get('patient/generate-profile', 
  array(
    'before' => 'auth',
    'uses' => 'PatientProfileController@generateProfile',
    'as' => 'generateProfile' 
));

// Show patient's event onset data

Route::get('patient/event-onset/{id}', 
  array(
    'before' => 'auth',
    'uses' => 'EventOnsetController@index',
    'as' => 'showEventOnset' 
));

/*
 * Authentication routes
 */

// Logout
Route::get('logout', 
  array(
    'uses' => 'AuthController@logout', 
    'as' => 'logout'
));

// Login
Route::post('login', 
  array(
    'uses' => 'AuthController@login', 
    'as' => 'login'
));

// Expiry
Route::get('expiry', 
  array(
    'uses' => 'AuthController@expiry', 
    'as' => 'expiry'
));


/*
 * POST Routes
 */

// Update patient profile

Route::post('patient/update-profile/{id}', 
  array(
    'before' => 'auth', 
    'uses' => 'PatientProfileController@updateProfile', 
    'as' => 'updatePatientProfile'
));

// Update event onset

Route::post('patient/update-event-onset/{id}',
  array(
    'before' => 'auth',
    'uses' => 'EventOnsetController@updateEventOnset',
    'as' => 'updateEventOnset'
));