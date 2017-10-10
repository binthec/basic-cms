<!DOCTYPE html>
<html class="no-js" lang="ja">

  <head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title> 転倒予防教室 | Admin </title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<!-- Place favicon.ico in the root directory -->
	<link rel="stylesheet" href="/backend/assets/css/vendor.css">
	<link rel="stylesheet" href="/backend/assets/css/app.css">
  </head>

  <body>
	<div class="auth">
	  <div class="auth-container">
		<div class="card">
		  <header class="auth-header">
			<h1 class="auth-title">
			  <div class="logo"> <span class="l l1"></span> <span class="l l2"></span> <span class="l l3"></span> <span class="l l4"></span> <span class="l l5"></span> </div>
			  Admin
			</h1>
		  </header>
		  <div class="auth-content">
			<p class="text-xs-center">Login</p>

			<form id="login-form" class="form-horizontal" method="POST" action="{{ route('login') }}">
			  {{ csrf_field() }}

			  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="name">ユーザ名</label>
				<input id="name" type="text" class="form-control underlined" name="name" value="{{ old('name') }}" required autofocus>
				@if ($errors->has('name'))
				<span class="help-block">
				  <strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			  </div>

			  <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
				<label for="password">パスワード</label>
				<input type="password" class="form-control underlined" name="password" id="password" required>
				@if ($errors->has('password'))
				<span class="help-block">
				  <strong>{{ $errors->first('password') }}</strong>
				</span>
				@endif
			  </div>

			  <div class="form-group">
				<label for="remember">
				  <input class="checkbox" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
						 <span>ログイン情報を保持する</span>
				</label>
			  </div>

			  <div class="form-group">
				<button type="submit" class="btn btn-block btn-primary">ログイン</button>
			  </div>

			</form>

		  </div>
		</div>

	  </div>
	</div><!-- /.auth -->

	<!-- Reference block for JS -->
	<div class="ref" id="ref">
	  <div class="color-primary"></div>
	  <div class="chart">
		<div class="color-primary"></div>
		<div class="color-secondary"></div>
	  </div>
	</div>
	<script src="/backend/assets/js/vendor.js"></script>
	<script src="/backend/assets/js/app.js"></script>
  </body>

</html>