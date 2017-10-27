@extends('backend.layouts.app')

@section('content')
    <div class="content">
        <div class="title-block">
            <h3 class="title"> アクションログ </h3>
            <p class="title-description"> 管理画面でログインや新規登録などの操作をした履歴を確認出来ます。</p>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-block sameheight-item">
                        {!! Form::open(['method' => 'GET', 'route' => 'actionlog.index', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            <label for="function-name" class="col-sm-2 control-label">機能名</label>
                            <div class="col-sm-4">
                                {!! Form::text('func_name', old('func_name'), ['id' => 'function-name', 'class' => 'form-control']) !!}
                            </div>

                            <label for="action-name" class="col-sm-2 control-label">操作内容</label>
                            <div class="col-sm-4">
                                {!! Form::text('action_name', old('action_name'), ['id' => 'action-name', 'class' => 'form-control']) !!}
                            </div>
                        </div><!-- form-group -->

                        <div class="form-group">
                            <label for="user-name" class="col-sm-2 control-label">操作したユーザ</label>
                            <div class="col-sm-4">
                                {!! Form::select('user_name', \App\User::getUserNames(), null, ['id' => 'user-name', 'class' => 'form-control', 'placeholder' => '選択してください']) !!}
                            </div>
                        </div><!-- form-group -->

                        <div class="form-group{{ $errors->has('date_start') || $errors->has('date_end') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-2 control-label">操作日時</label>
                            <div class="col-sm-10 form-inline">
                                {!! Form::text('date_start', old('date_start'), ['id' => 'date_start', 'class' => 'form-control use-calendar']) !!}
                                〜
                                {!! Form::text('date_end', old('date_end'), ['id' => 'date_end', 'class' => 'form-control use-calendar']) !!}
                            </div>
                        </div><!-- form-group -->

                        <div class="card-footer text-center">
                            {!! Form::submit('検　　索',['class' => 'btn btn-success']) !!}&emsp;
                            <a href="{{ route('actionlog.index') }}" class="btn btn-warning">リセット</a>
                        </div>

                        {!! Form::close() !!}
                    </div><!-- /.card -->

                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </section>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-block sameheight-item">

                        @if($logs->count() > 0)
                            <table class="table table-bordered with-btn">
                                <thead>
                                <tr class="bg-primary text-center">
                                    <th width="5%">ID</th>
                                    <th>機能名</th>
                                    <th>操作内容</th>
                                    <th>操作したユーザ</th>
                                    <th>操作日時</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr class="text-center">
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->route }}</td>
                                        <td class="text-center">
                                            <label class="label label-lg {{ \App\ActionLog::$labelColor[$log->method] }}">
                                                {{ \App\ActionLog::$actionLabels[$log->method] }}
                                            </label>
                                        </td>
                                        <td>{{ $userNames[$log->user_id] }}</td>
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <i class="fa fa-warning"></i> ログが存在しません。
                        @endif

                        <div class="card-footer text-center">
                            {{ $logs->links() }}
                        </div>

                    </div><!-- /.card -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </section>
    </div>
@endsection

@section('js')
    <script>
        //ユーザ名選択部分で予測検索出来るselect2を利用
        $(function () {
            $('#user-name').select2();
        });
    </script>
@endsection
