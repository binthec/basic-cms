<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

	/**
	 * １ページに表示する件数
	 */
	const PAGINATION = 10;

	/**
	 * ユーザ一覧画面
	 */
	public function index()
	{
		$users = User::paginate(self::PAGINATION);
		return view('backend.user.index', compact('users'));
	}

}
