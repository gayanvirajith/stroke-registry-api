<?php

class EventOnsetController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Event Onset controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for patient's event onset.
	|
	|	TODO: 
	|		-	patient may have multiple event onsets.
	|
	| Actions:
	|		- index
	| 	- updateEventOnset
	*/


	/**
	 * Return patient's event onset data  
	 *
	 */		
	public function index($id) {

		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
				$response['message'] = 
					"Could not find a patient with the id of {$id}, Please try again";	
				return Response::make($response, 500);
		}

		// Retrieve the event onset by the patient id, 
		// Or create it if it doesn't exist...		
		$eventOnset = EventOnset::firstOrCreate(array('patient_id' => $id));

		// Response array to return
		$response = [
			'message' => 'Event onset data retrieved!'
		];

		$response['eventOnset'] = $eventOnset;

		return Response::make($response);

	}

	/**
	 * Update patient's event onset data via POST request.
	 * Access JSON request, process payload with model validations 
	 * and finally save data into persistent storage.
	 *
	 * @return JSON Response
	 */
	public function updateEventOnset($id) {

		// Find patient by id
		$patient = Patient::find($id);

		if (!$patient) {
				$response['message'] = 
					"Could not find a patient with the id of {$id}, Please try again";	
				return Response::make($response, 500);
		}

		// Retrieve the event onset by the patient id, 
		// Or create it if it doesn't exist...
		$eventOnset = EventOnset::firstOrCreate(array('patient_id' => $id));

		// Response array to return
		$response = [
			'message' => 'Event onset has been updated!'
		];

		//todo implement update functionality with validation 
		
		$response['eventOnset'] = $eventOnset;

		return Response::make($response);

	}

}