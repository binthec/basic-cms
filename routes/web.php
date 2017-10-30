<?php

/**
 * 管理画面側
 */
Route::domain(env('BACKEND_DOMAIN'))->group(function() {
	/**
	 * 認証しなくても見られる画面
	 */
	Route::middleware('guest')->group(function() {
		Route::get('/', 'Backend\Auth\LoginController@showLoginForm');

		//認証系
		Route::get('login', 'Backend\Auth\LoginController@showLoginForm');
		Route::post('login', 'Backend\Auth\LoginController@login')->name('login');
//		Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//		Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//		Route::post('password/reset', 'Backend\Auth\ForgotPasswordController@reset');
//		Route::get('password/reset/{token}', 'Backend\Auth\ForgotPasswordController@showResetForm')->name('password.reset');
	});

	/**
	 * 認証の必要な画面
	 */
	Route::middleware('auth')->group(function() {
		Route::get('/dashboard', 'Backend\HomeController@index')->name('dashboard');

		//ログアウト
        Route::post('logout', 'Backend\Auth\LoginController@logout')->name('logout');

		//ユーザ管理
		Route::get('user', 'Backend\UserController@index')->name('user');
		Route::get('register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('register');
		Route::post('register', 'Backend\Auth\RegisterController@register');

		//トップ画像
		Route::resource('topimage', 'Backend\TopimageController');

		//アクションログ
        Route::resource('actionlog', 'Backend\ActionLogController');

        //活動報告
        Route::resource('activity', 'Backend\ActivityController');
	});
});


/**
 * フロント側
 */
Route::domain(env('FRONTEND_DOMAIN'))->group(function() {
	Route::get('/', 'Frontend\HomeController@index')->name('home');

	//活動の様子
	Route::get('/activity', 'Frontend\HomeController@activity');
});
