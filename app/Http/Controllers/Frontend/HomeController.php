<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('frontend.home');
	}

	/**
	 * 活動の様子
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function activity()
	{
		return view('frontend.activity');
	}

}
