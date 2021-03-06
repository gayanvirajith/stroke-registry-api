<?php

class EventOnsetController extends \ApiController {

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
	|	- index
	| 	- updateEventOnset
	*/


	/**
	 * @var \Acme\Transformers\EventOnsetTransformer
     */
	protected $eventOnsetTransformer;


	/**
	 * @param \Acme\Transformers\EventOnsetTransformer $eventOnsetTransformer
     */
	function __construct(Acme\Transformers\EventOnsetTransformer
						 $eventOnsetTransformer)
	{
		$this->beforeFilter('auth');
		$this->eventOnsetTransformer = $eventOnsetTransformer;
	}


	/**
	 * Return patient's event onset data
	 * GET patient/event-onset/{id}
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

		// Retrieve the event onset by the patient id,
		// Or create it if it doesn't exist...
		$eventOnset = EventOnset::firstOrCreate(array('patient_id' => $id));

		// Response array to return
		$response = [
			'message' => 'Event onset data retrieved!'
		];
		$eventOnset->symptoms;
		$response['eventOnset'] = $eventOnset;

		return $this->respond([
			'data' => $this->eventOnsetTransformer->transform($eventOnset)
		]);

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

		// Validate POST data
		$validator = EventOnset::validate(Input::all());
		if ($validator->passes()) {

			// Build event onset object object

			$data = Input::all();
			$symptoms = Input::get('symptoms');
			unset($data['symptoms']);

			$eventOnsetBuilder = new EventOnsetBuilder($data, $eventOnset);
			$eventOnsetBuilder->build();
			$eventOnset = $eventOnsetBuilder->getEventOnset();

			// Update event onset data data
			$eventOnset->save();
			// Sync symptoms
			$eventOnset->symptoms()->sync(array_unique($symptoms));

			return Response::make($response);

		} else {

			$messages = $validator->messages();
			$errors = [];

			foreach(array_keys(EventOnset::$rules) as $key) {
				if ($messages->has($key)) $errors[] = $messages->first($key);
			}

			$response['message'] = 'Event onset update failed, Please try again';
			$response['errors'] = $errors;

			return
				$this->respondWithError(
					'Event onset update failed, Please try again!',
					$response
				);
		}

	}

}