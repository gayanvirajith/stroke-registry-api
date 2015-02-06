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
	| 	- generateProfile
	|		- 
	*/

	/*
	 * Generate empty patient profile and returns back the id
	 */
	public function generateProfile() {

		// Get Autheniticated user 
		$user = Auth::user();

		// Retrieve the patient by creating empty patient
		$patient = Patient::Create(
			array(
				'hospital_id' => $user->hospital_id
		));

		$response = [
			'message' => 'Patient profile has been created!',
			'id' => $patient->id,
			'hospital_id' => $patient->hospital_id
		];

		return Response::make($response);
	}

}