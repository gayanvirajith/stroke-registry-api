<?php

class DrugHistoryController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Drug History controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for manage drug history of a patient.
	|
	| Actions:
	|		- index
	| 	- updateDrugHistory
	*/


	/**
	 * Default constructor
	 */
	function __construct()
	{
		$this->beforeFilter('auth');
	}
	/**
	 * Returns patient's drug history data.
	 * GET patient/drug-history/{id}
	 *
	 * @param id
	 * @return Response
	 *
	 */
	public function index($id)
	{
		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
				$response['message'] = 
					"Could not find a patient with the id of {$id}, Please try again";	
				return Response::make($response, 500);
		}

		// Retrieve the event onset by the patient id, 
		// Or create it if it doesn't exist...		
		$eventOnset = DrugHistory::firstOrCreate(array('patient_id' => $id));

		// Response array to return
		$response = [
			'message' => 'Drug history data retrieved!'
		];

		$response['drugHistory'] = $eventOnset;

		return Response::make($response);

	}


	/**
	 * Update patient's event onset data via POST request.
	 * Access JSON request, process payload with model validations 
	 * and finally save data into persistent storage.
	 * POST patient/update-drug-history/{id}
	 *
	 * @param id
	 * @return JSON Response
	 */
	public function updateDrugHistory($id) {

		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
				$response['message'] = 
					"Could not find a patient with the id of {$id}, Please try again";	
				return Response::make($response, 500);
		}

		// Retrieve the drug history by the patient id, 
		// Or create it if it doesn't exist...
		$drugHistory = DrugHistory::firstOrCreate(array('patient_id' => $id));

		// Response array to return
		$response = [
			'message' => 'Drug history has been updated!'
		];

		// Validate POST data 
    $validator = DrugHistory::validate(Input::all());

		if ($validator->passes()) {
			
			// Build event onset object object

			$data = Input::all();
		
    	$drugHistoryBuilder = new DrugHistoryBuilder($data, $drugHistory);
			$drugHistoryBuilder->build();
			$drugHistory = $drugHistoryBuilder->getDrugHistory();

			// Update event onset data data
			$drugHistory->save();

			return Response::make($response);

		} else {

			$messages = $validator->messages();
      $errors = [];

    	foreach(array_keys(drugHistory::$rules) as $key) {
    		if ($messages->has($key)) $errors[] = $messages->first($key);
    	}

			$response['message'] = 'Event onset update failed, Please try again';	
			$response['errors'] = $errors;	

			return Response::make($response, 500);
		}

		$response['drugHistory'] = $drugHistory;

		return Response::make($response);

	}
}