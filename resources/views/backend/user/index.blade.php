@extends('backend.layouts.app')

@section('content')
<article class="content">
  <div class="title-block">
	<h3 class="title"> ユーザ一覧 </h3>
	<p class="title-description"> 管理者としてログイン出来るユーザの一覧です </p>
  </div>

  <section class="section">
	<div class="row">
	  <div class="col-md-12">
		<div class="card card-block sameheight-item">
		  <!--		  <div class="title-block">
					  <h3 class="title"> 一覧 </h3>
					</div>-->

		  @if($users->count() > 0)
		  <table class="table table-bordered">
			<thead>
			  <tr class="bg-primary">
				<th>ID</th><th>名前</th><th>操作</th>
			  </tr>
			</thead>
			<tbody>
			  @foreach($users as $user)
			  <tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>
				  <a class="btn btn-primary">ユーザ名変更</a>
				  <a class="btn btn-warning">パスワード変更</a>
				</td>
			  </tr>
			  @endforeach
			</tbody>
		  </table>
		  @else
		  ユーザが存在しません
		  @endif

		  @if($users->count() > 0)
		  {{ $users->links() }}
		  @endif

		</div><!-- /.card -->
	  </div><!-- /.col-md-12 -->
	</div><!-- /.row -->
  </section>
</article>
@endsection
