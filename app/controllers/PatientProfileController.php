<?php

class PatientProfileController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Patient profile controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for generating new patient record
	| and manage updates.
	|	
	| Actions:
	| 	- generateProfile
	|	- updateProfile
	*/


	/**
	 * Default constructor
     */
	function __construct()
	{
		$this->beforeFilter('auth');
	}


	/**
	 * Generate empty patient profile and returns back the id.
	 * Accepts a GET request.
	 *
	 * @return JSON Response
	 */
	public function generateProfile() {

		// Get Authenticated user
		$user = Auth::user();

		// Generate unique id
		$uuid = Uuid::uuid4();

		// Retrieve the patient by creating empty patient
		$patient = new Patient;
		$patient->hospital_id = $user->hospital_id;
		$patient->stroke_id		= $uuid->toString();
		$patient->save();

		$response = [
			'message' => 'Patient profile has been created!',
			'id' => $patient->id,
			'hospital_id' => $patient->hospital_id,
			'stroke_id' => $patient->stroke_id
		];

		return $this->respondCreated($response);

	}


	/**
	 * Update patient profile details via POST request.
	 * Accepts JSON request and process JSON payload with model validations
	 * and finally persist the data into storage.
	 *
	 * @return JSON Response
	 */
	public function updateProfile($id) {

		// Response array to return
		$response = [
			'message' => 'Patient profiles has been updated!'
		];

		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
			$response['message'] =
				'Could not find a patient with the id of {$id}, Please try again';
			return Response::make($response, 500);
		}

		// Validate POST data 
		$validator = Patient::validate(Input::all());

		if ($validator->passes()) {

			// Build patient object
			$patientBuilder = new PatientBuilder(Input::all(), $patient);
			$patientBuilder->build();
			$patient = $patientBuilder->getPatient();

			// Update patient data
			$patient->save();

			return Response::make($response);

		} else {

			$messages = $validator->messages();
			$errors = [];

			foreach(array_keys(Patient::$rules) as $key) {
				if ($messages->has($key)) $errors[] = $messages->first($key);
			}

			$response['message'] = 'Patient profile update failed, Please try again';
			$response['errors'] = $errors;

			return Response::make($response, 400);

		}

		return Response::make($response);

	}
}