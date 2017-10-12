@extends('backend.layouts.app')

@section('content')
<article class="content">
  <div class="title-block">
	<h3 class="title"> ユーザ一覧 </h3>
	<p class="title-description"> 管理者としてログイン出来るユーザの一覧です </p>
  </div>
  <div class="subtitle-block">
	<h3 class="subtitle">  </h3>
  </div>

  <section class="section">
	<div class="row">
	  <div class="col-md-12">
		<div class="card card-block sameheight-item">
		  <div class="title-block">
			<h3 class="title"> Forms Using the Grid </h3>
		  </div>
		  <form>
			<div class="form-group row"> <label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
			  <div class="col-sm-10"> <input type="email" class="form-control" id="inputEmail3" placeholder="Email"> </div>
			</div>
			<div class="form-group row"> <label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>
			  <div class="col-sm-10"> <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> </div>
			</div>
			<div class="form-group row">
			  <div class="col-sm-offset-2 col-sm-10"> <button type="submit" class="btn btn-success">Sign in</button> </div>
			</div>
		  </form>
		</div>
	  </div>
	</div><!-- /.row -->
  </section>
</article>
@endsection
