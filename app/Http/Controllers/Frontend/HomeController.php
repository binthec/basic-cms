<?php

namespace App\Http\Controllers\Frontend;

use App\Topimage;
use App\Activity;
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
	    $topimages = Topimage::open()->get();
	    $activities = Activity::open()->take(4)->get();
		return view('frontend.home', compact('topimages', 'activities'));
	}

}
