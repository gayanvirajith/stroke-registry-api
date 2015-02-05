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

Route::get('/', 
  array(
    'before' => 'auth',
    'uses' => 'HomeController@showWelcome', 
    'as' => 'home' 
));

Route::get('patient/generate-profile', 
  array(
    'before' => 'auth',
    'uses' => 'PatientProfileController@generateProfile',
    'as' => 'generateProfile' 
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