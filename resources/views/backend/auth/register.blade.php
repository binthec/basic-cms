@extends('backend.layouts.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>ユーザを新規登録</h1>
            <small>管理者としてログイン出来るユーザを新規登録します。</small>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    {!! Form::open(['method' => 'POST', 'url' => route('register'), 'class' => 'form-horizontal']) !!}
                    {{ csrf_field() }}

                    <div class="box">
                        <div class="box-body">

                            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">ユーザ名</label>
                                <div class="col-sm-9">
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'ユーザ名']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-sm-3 control-label">パスワード</label>
                                <div class="col-sm-9">
                                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'パスワード']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label for="password-confirmation" class="col-sm-3 control-label">パスワード再入力</label>
                                <div class="col-sm-9">
                                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirmation', 'placeholder' => 'パスワード']) !!}
                                </div>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-9 col-sm-offset-3">
                                {!! Form::submit('登録する', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>

    </div><!-- ./content-wrapper -->
@endsection
