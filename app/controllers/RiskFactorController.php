<?php

/**
 * Class RiskFactorController
 */
class RiskFactorController extends \ApiController {

    /*
	|--------------------------------------------------------------------------
	| Event Onset controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for patient's risk factor data.
	|
	|
	| Actions:
	|	- index
	*/


    /**
     * @var \Acme\Transformers\RiskFactorTransformer
     */
    protected $riskFactorTransformer;


    /**
     * @param \Acme\Transformers\RiskFactorTransformer $riskFactorTransformer
     */
    function __construct(Acme\Transformers\RiskFactorTransformer $riskFactorTransformer)
    {
        $this->beforeFilter('auth');
        $this->riskFactorTransformer = $riskFactorTransformer;
    }


    /**
     * Return patient's risk-factor data
     * GET patient/risk-factor/{id}
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
        $riskFactor = RiskFactor::firstOrCreate(array('patient_id' => $id));


        $riskFactor->otherHeartDiseases;

        return $this->respond([
            'data' => $this->riskFactorTransformer->transform($riskFactor)
        ]);

    }


    /**
     * Update patient's risk factor data via POST request.
     * Access JSON request, process payload with model validations
     * and finally save data into persistent storage.
     *
     * @return JSON Response
     */
    public function updateRiskFactor($id) {

        // Find patient by id
        $patient = Patient::find($id);

        if (!$patient) {
            $response['message'] =
                "Could not find a patient with the id of {$id}, Please try again";
            return Response::make($response, 500);
        }

        // Retrieve the event onset by the patient id,
        // Or create it if it doesn't exist...
        $riskFactor = RiskFactor::firstOrCreate(array('patient_id' => $id));


        // Validate POST data
        $validator = RiskFactor::validate(Input::all());

        if ($validator->passes()) {

            // Build event onset object object

            $data = Input::all();
            $otherHeartDiseases = Input::get('otherHeartDiseases');
            unset($data['otherHeartDiseases']);

            $riskFactorBuilder = new RiskFactorBuilder($data, $riskFactor);
            $riskFactorBuilder->build();
            $riskFactor = $riskFactorBuilder->getRiskFactor();

            // Update risk factor data
            $riskFactor->save();
            // Sync $otherHeartDiseases
            $riskFactor->otherHeartDiseases()->sync(array_unique($otherHeartDiseases));

            return $this->respond([
                'message' => 'Risk factor data has been updated!'
            ]);

        } else {

            $messages = $validator->messages();
            $errors = [];

            foreach(array_keys(RiskFactor::$rules) as $key) {
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