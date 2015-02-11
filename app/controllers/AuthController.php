<?php

class AuthController extends ApiController {

	/*
	|--------------------------------------------------------------------------
	| Authentication controller
	|--------------------------------------------------------------------------
	|
	| This controller will responsible for handle authentication.
	|
	| Actions:
	|	- login
	| 	- logout
	|	- expiry
	*/

	/**
	 * @var Acme\Transformers\UserTransformer
     */
	protected $userTransformer;


	/**
	 * @param \Acme\Transformers\UserTransformer $userTransformer
     */
	function __construct(Acme\Transformers\UserTransformer $userTransformer)
	{
		$this->userTransformer = $userTransformer;
	}


	/*
	 * User login action
	 * POST /login
	 *
	 */
	public function login() {

		$user = [
			'username' => Input::get('username'),
			'password' => Input::get('password')
		];

		if (Auth::attempt($user)) {

			return $this->respond([
				'data' => $this->userTransformer->transform(Auth::user())
			]);
		} else {
			return
				$this->respondBadRequest(
					'Your username/password combination was incorrect!'
				);
		}

	}

	/*
	 * User logout action
	 * GET /logout
	 *
	 */
	public function logout() {
		if (Auth::check()) {

			Auth::logout();

			return $this->respond([
				'message' => 'You are now logged out!'
			]);
		} else {
			return $this->respondUnauthorized('Please login!');
		}
	}

	/*
	 * Session expiry check action
	 * GET /expiry
	 *
	 */
	public function expiry() {
		
		if (Auth::check()) {
			return $this->respond([
				'message' => 'You are good to go!'
			]);
		} else {
			return $this->respondUnauthorized('Your session has been expired!');
		}
	}
}