<?php

class PatientProfileController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Patient profile controller
	|--------------------------------------------------------------------------
	|
	| This controller will be responsibled for generating new patient recored
	| and manage updates.
	|	
	| Actions:
	| 	- generateId
	|		- 
	*/

	/*
	 * Generate empty patient profile and returns back the id
	 */
	public function generateProfile() {

		// Retrieve the patient by creating empty patient 
		$patient = Patient::Create(array());

		$response = [
			'message' => 'Patient profile has been created!',
			'id' => $patient->id
		];

		return Response::make($response);
	}

}