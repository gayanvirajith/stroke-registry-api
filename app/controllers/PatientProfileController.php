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
	|	- index
	| 	- generateProfile
	|	- updateProfile
	*/


	/**
	 * @var \Acme\Transformers\PatientTransformer
     */
	protected $patientTransformer;


	/**
	 * @param \Acme\Transformers\PatientTransformer $patientTransformer
     */
	function __construct(Acme\Transformers\PatientTransformer
						 $patientTransformer)
	{
		$this->patientTransformer = $patientTransformer;
		$this->beforeFilter('auth');
	}


	/**
	 * Return patient's data
	 * GET patient/{id}
	 *
	 * @param id
	 * @return Response
	 *
	 */
	public function index($id) {

		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
			return
				$this->respondBadRequest(
					"Could not find a patient with the id of {$id}, Please try again!"
				);
		}
		return $this->respond([
			'data' => $this->patientTransformer->transform($patient)
		]);
	}

	/**
	 * Generate empty patient profile and returns back the id.
	 * Accepts a POST request.
	 *
	 * @return JSON Response
	 */
	public function generateProfile() {

		// Get Authenticated user
		$user = Auth::user();

		// Retrieve the patient by creating empty patient
		$patient = new Patient;
		$patient->hospital_id = $user->hospital_id;
		$patient->name = Input::get('name');
		$patient->nic = Input::get('nic');
		$patient->save();

		return $this->respond([
			'data' => $this->patientTransformer->transform($patient)
		]);

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