<?php

class PatientDirectoryController extends ApiController {


	//PatientDirectoryTransformer

	/**
	 * @var \Acme\Transformers\PatientDirectoryTransformer
   */
	protected $patientDirectoryTransformer;

	/**
	 * @param \Acme\Transformers\PatientDirectoryTransformer $patientDirectoryTransformer
   */
	function __construct(Acme\Transformers\PatientDirectoryTransformer
						 $patientDirectoryTransformer)
	{
		$this->patientDirectoryTransformer = $patientDirectoryTransformer;
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 * GET /patientdirectory
	 *
	 * @return Response
	 */
	public function index()
	{
    // Get Authenticated user
    $user = Auth::user();
    $hospital_id = $user->hospital_id;

    $patients = Patient::where('hospital_id', '=', $hospital_id)->get()->toArray();
    return $this->respond([
			'data' => $this->patientDirectoryTransformer->transformCollection($patients)
		]);

	}

}