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

/**
 * SET PERMISSIONS
 *
 * Only users with roles that have the 'generate_new_patient_profile'
 * permission will be able to access patient/generate-profile route.
 */
Route::when('patient/generate-profile', 'generate_new_patient_profile');


/**
 * Custom validation hooks
 */

Validator::resolver(function ($translator, $data, $rules, $messages)
{
    return new ExtendedValidator($translator, $data, $rules, $messages);
});

// Patient profile
Validator::extend('province', 'PatientValidation@provinceCheck');
Validator::extend('marital', 'PatientValidation@martialStatusCheck');
Validator::extend('education', 'PatientValidation@educationCheck');
Validator::extend('employment', 'PatientValidation@employmentCheck');
Validator::extend('levelOfIndependence', 'PatientValidation@levelOfIndependenceCheck');
Validator::extend('livingArrangement', 'PatientValidation@livingArrangementCheck');
Validator::extend('ethnicity', 'PatientValidation@ethnicityCheck');
Validator::extend('postpartum', 'PatientValidation@postpartumCheck');
Validator::extend('admittedTo', 'PatientValidation@admittedCheck');

// Event onset
Validator::extend('symptoms', 'EventOnsetValidation@symptomsCheck');
Validator::extend('presentationTo', 'EventOnsetValidation@presentationCheck');
Validator::extend('transportOption', 'EventOnsetValidation@transportOptionCheck');
Validator::extend('oxfordshireClassification',
    'EventOnsetValidation@oxfordshireCommunityClassificationOptionsCheck');
Validator::extend('sideOfSymptoms', 'EventOnsetValidation@sideOfSymptomsOptionsCheck');

// Drug history
Validator::extend('antiplatelet', 'DrugHistoryValidation@antiplateletCheck');
Validator::extend('anticoagulation', 'DrugHistoryValidation@anticoagulationCheck');


/*
 * GET Routes
 */

// Root route (Home page)

Route::get('/',
    array(
        'uses' => 'HomeController@index',
        'as'   => 'home'
    ));


// Get patient data
Route::get('patient/{id}',
    array(
        'uses' => 'PatientProfileController@index',
        'as'   => 'PatientProfile'
    ));



// Show patient's event onset data

Route::get('patient/event-onset/{id}',
    array(
        'uses' => 'EventOnsetController@index',
        'as'   => 'showEventOnset'
    ));

// Show patient's drug history data

Route::get('patient/drug-history/{id}',
    array(
        'uses' => 'DrugHistoryController@index',
        'as'   => 'showDrugHistory'
    ));

// Show patient's risk factor data
Route::get('patient/risk-factor/{id}',
    array(
        'uses' => 'RiskFactorController@index',
        'as'   => 'showRiskFactor'
    ));

/*
 * Authentication routes
 */

// Logout
Route::get('logout',
    array(
        'uses' => 'AuthController@logout',
        'as'   => 'logout'
    ));

// Login
Route::post('login',
    array(
        'uses' => 'AuthController@login',
        'as'   => 'login'
    ));

// Expiry
Route::get('expiry',
    array(
        'uses' => 'AuthController@expiry',
        'as'   => 'expiry'
    ));


/*
 * POST Routes
 */
// Generate patient profile

Route::post('patient/generate-profile',
    array(
        'uses' => 'PatientProfileController@generateProfile',
        'as'   => 'generateProfile'
    ));

// Update patient profile

Route::post('patient/update-profile/{id}',
    array(
        'uses' => 'PatientProfileController@updateProfile',
        'as'   => 'updatePatientProfile'
    ));

// Update event onset

Route::post('patient/update-event-onset/{id}',
    array(
        'uses' => 'EventOnsetController@updateEventOnset',
        'as'   => 'updateEventOnset'
    ));

// Update drug history

Route::post('patient/update-drug-history/{id}',
    array(
        'uses' => 'DrugHistoryController@updateDrugHistory',
        'as'   => 'updateDrugHistory'
    ));

// Update risk factor

Route::post('patient/update-risk-factor/{id}',
    array(
        'uses' => 'RiskFactorController@updateRiskFactor',
        'as'   => 'updateRiskFactor'
    ));


/*
 * Test route to check pdo support on a shared server
 */
Route::get('test-pdo', function() {

    try {
        $users = DB::table('users')->count();
        echo $users;

    }catch(Exception $e){
        echo "Error : " + $e;
    }

});




//This will redirect all missing routes to AngularJS Framework .
App::missing(function($exception)
{
    /*
     * The reason for this is that when you first visit 
     * the page (/about), e.g. after a refresh, the browser has 
     * no way of knowing that this isn't a real url, 
     * so it goes ahead and loads it. However if you have loaded 
     * up the root page first, and all the javascript code, 
     * then when you navigate to /about angular can get in there 
     * before the browser tries to hit the server and handle it accordingly.
     * @see: http://stackoverflow.com/questions/16569841/angularjs-html5-mode-reloading-the-page-gives-wrong-get-request/16570533#16570533
     */
    if (App::environment() === 'production')
        return View::make('angularjs.application_production');
    
    return View::make('angularjs.application');

});