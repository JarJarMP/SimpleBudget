<?php

class AuthController extends BaseController
{
	private $form_rules; // array - default form rules for validation

	public function __construct()
	{
		$this->form_rules = array(
			'email' => 'required|email',
			'password' => 'required',
		);
	}

	public function getRegister()
	{
		if ($this->registrationIsEnabled()) {
			return View::make('pages/register');
		} else {
			return Redirect::route('login');
		}		
	}

	public function postRegister()
	{
		if ($this->registrationIsEnabled()) {
			$validaton = Validator::make(Input::all(), $this->form_rules);

			if ($validaton->fails()) {
				return Redirect::route('register')->withErrors($validaton);
			}

			$user = new User;
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
		}

		return Redirect::route('login');
	}

	public function getLogin()
	{
		$view_data = array(
			'registration_enabled' => $this->registrationIsEnabled(),
		);

		return View::make('pages/login', $view_data);
	}

	public function postLogin()
	{
		$validaton = Validator::make(Input::all(), $this->form_rules);

		if ($validaton->fails()) {
			return Redirect::route('login')->withErrors($validaton);
		}

		$auth_data = array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
		);

		$auth = Auth::attempt($auth_data, false);

		if ($auth !== true) {
			return Redirect::route('login')->withErrors(array(
				'Wrong email or password!',
			));
		}

		return Redirect::route('home');
	}

	public function getLogout()
	{
		Auth::logout();

		return Redirect::route('login');
	}

	private function registrationIsEnabled()
	{
		$users = User::all();
		$users_count = $users->count();

		return empty($users_count) ? true : false;
	}
}