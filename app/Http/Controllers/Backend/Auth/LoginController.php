<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	/*
	  |--------------------------------------------------------------------------
	  | Login Controller
	  |--------------------------------------------------------------------------
	  |
	  | This controller handles authenticating users for the application and
	  | redirecting them to your home screen. The controller uses a trait
	  | to conveniently provide its functionality to your applications.
	  |
	 */

use AuthenticatesUsers;

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/dashboard';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
//	public function __construct()
//	{
//		$this->middleware('guest')->except('logout');
//	}

	/**
	 * ログインフォーム表示のパスを変更
	 *
	 * @return type
	 */
	public function showLoginForm()
	{
		return view('backend.auth.login');
	}

	/**
	 * ログイン時に使うカラム名を変更
	 *
	 * @return string
	 */
	public function username()
	{
		return 'name';
	}

}
