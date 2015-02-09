<?php

class DrugHistoryController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Drug History controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for patient's drug history.
	|
	| Actions:
	|		- index
	| 	- updateDrugHistory
	*/

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

}