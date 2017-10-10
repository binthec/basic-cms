@extends('frontend.layouts.app')

@section('content')
<section id="blog-detail">
  <div class="container">
	<div class="section-header">
	  <h2 class="section-title text-center wow fadeInDown">最近の活動の様子</h2>
	  <p class="text-center wow fadeInDown">
		最近の活動の内容をご紹介します。
	  </p>
	</div>

	<div class="row">

	  <div class="col-md-12 post">
		あいうえお
	  </div><!-- /.col-md-12 -->

	</div><!-- /.row -->


	<div class="row">

	  <div class="col-md-2 small-post">
		<img src="/frontend/assets/images/blog1.jpg" class="thum">
		<div class="post-text">
		  <p class="date">日付</p>
		  <p class="place">場所</p>
		  <a class="btn btn-primary" href="/activity">読む</a>
		</div><!-- /.post-text -->
	  </div><!-- /.col-sm-2 -->

	  <div class="col-md-2 small-post">
		<img src="/frontend/assets/images/blog1.jpg" class="thum">
		<div class="post-text">
		  <p class="date">日付</p>
		  <p class="place">場所</p>
		  <a class="btn btn-primary" href="/activity">読む</a>
		</div><!-- /.post-text -->
	  </div><!-- /.col-sm-2 -->

	</div><!-- /.row -->

  </div><!-- /.container -->
</section>

@endsection
