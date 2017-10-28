@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>ユーザ{{ ($topimage->id === null)? '新規登録' : '編集' }}</h1>
            <small>管理者としてログイン出来るユーザを{{ ($topimage->id === null)? '新規登録' : '編集' }}します。</small>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">

                        <div class="box-body">

                        <form>
                            <div class="form-group row"><label for="inputEmail3" class="col-sm-2 form-control-label">Email</label>
                                <div class="col-sm-10"><input type="email" class="form-control" id="inputEmail3" placeholder="Email"></div>
                            </div>
                            <div class="form-group row"><label for="inputPassword3" class="col-sm-2 form-control-label">Password</label>
                                <div class="col-sm-10"><input type="password" class="form-control" id="inputPassword3" placeholder="Password"></div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">Sign in</button>
                                </div>
                            </div>
                        </form>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">登　録</button>
                            </div>
                        </div><!-- /.box-footer -->

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section>

    </div><!-- ./content-wrapper -->

@endsection
