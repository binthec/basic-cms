@extends('backend.layouts.app')

@section('content')
<article class="content">
  <div class="title-block">
	<h3 class="title"> ユーザ新規登録 </h3>
	<p class="title-description"> 管理者としてログイン出来るユーザを新しく追加します </p>
  </div>
  <div class="subtitle-block">
	<h3 class="subtitle">  </h3>
  </div>

  <section class="section">
	<div class="row">
	  <div class="col-md-12">
		<div class="card card-block sameheight-item">
		  <div class="title-block">
			<h3 class="title"> 入力してください </h3>
		  </div>

		  <form class="form-horizontal" method="POST" action="{{ route('register') }}">
			{{ csrf_field() }}

			<div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
			  <label for="name" class="col-sm-3 form-control-label">ユーザ名</label>
			  <div class="col-sm-9">
				<input type="text" class="form-control" id="name" placeholder="ユーザ名" value="{{ old('name') }}" required autofocus>
				@if ($errors->has('name'))
				<span class="help-block">
				  <strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			  </div>
			</div>

			<div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
			  <label for="password" class="col-sm-3 form-control-label">パスワード</label>
			  <div class="col-sm-9">
				<input type="password" class="form-control" name="password" id="password" placeholder="パスワード" required>
			  </div>
			  @if ($errors->has('password'))
			  <span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			  </span>
			  @endif
			</div>

			<div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
			  <label for="password-confirm" class="col-sm-3 form-control-label">パスワード再入力</label>
			  <div class="col-sm-9">
				<input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="パスワード" required>
			  </div>
			</div>

			<div class="form-group row">
			  <div class="col-sm-9 col-sm-offset-3">
				<button type="submit" class="btn btn-success">登録する</button>
			  </div>
			</div>

		  </form>

		</div>
	  </div>
	</div><!-- /.row -->
  </section>
</article>


<div class="container">
  <div class="row">
	<div class="col-md-8 col-md-offset-2">
	  <div class="panel panel-default">
		<div class="panel-heading">Register</div>

		<div class="panel-body">
		  <form class="form-horizontal" method="POST" action="{{ route('register') }}">
			{{ csrf_field() }}

			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			  <label for="name" class="col-md-4 control-label">Name</label>

			  <div class="col-md-6">
				<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

				@if ($errors->has('name'))
				<span class="help-block">
				  <strong>{{ $errors->first('name') }}</strong>
				</span>
				@endif
			  </div>
			</div>



			<div class="form-group">
			  <div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
				  Register
				</button>
			  </div>
			</div>
		  </form>
		</div>
	  </div>
	</div>
  </div>
</div>
@endsection
