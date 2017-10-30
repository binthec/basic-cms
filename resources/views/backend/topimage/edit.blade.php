@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <h1>トップ画像{{ ($topimage->id === null)? '新規登録' : '編集' }}</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> トップページのスライダーに表示する画像を{{ ($topimage->id === null)? '新規登録' : '編集' }}します。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    @if($topimage->id === null)
                        {!! Form::open(['method' => 'post', 'route' => 'topimage.store','enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['topimage.update', $topimage],'enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>
                        <div class="box-body">

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">名前 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('name', ($topimage->id !== null)? $topimage->name: '', ['id' => 'name', 'class' => 'form-control']) }}
                                    @if($errors->has('name'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('name') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">

                                <label for="topimage" class="col-sm-3 control-label">公開ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if($topimage->id === null || $topimage->status === \App\Topimage::OPEN)
                                            {{ Form::radio('status', \App\Topimage::OPEN, true, ['class' => 'flat-blue']) }} 公開
                                        @else
                                            {{ Form::radio('status', \App\Topimage::OPEN, '', ['class' => 'flat-blue']) }} 公開
                                        @endif
                                    </label>
                                    <label class="radio-inline">
                                        @if($topimage->id !== null && $topimage->status === \App\Topimage::CLOSE)
                                            {{ Form::radio('status', \App\Topimage::CLOSE, true, ['class' => 'flat-blue']) }} 非公開
                                        @else
                                            {{ Form::radio('status', \App\Topimage::CLOSE, '', ['class' => 'flat-blue']) }} 非公開
                                        @endif
                                    </label>

                                    @if($errors->has('status'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('status') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('topimage') ? ' has-error' : '' }}">
                                <label for="topimage"
                                       class="col-sm-3 control-label">画像{!! ($topimage->id === null)? ' <span class="text-danger">*</span>' : '' !!}</label>
                                <div class="col-sm-9">
                                    {{ Form::file('topimage',['id' => 'topimage']) }}
                                    <span class="help-block">
                                    <p class="text-warning">※高さ600px以上の画像推奨</p>
                                        @if($errors->has('topimage'))
                                            <strong class="text-danger">{{ $errors->first('topimage') }}</strong>
                                        @endif
                                </span>

                                    @if($topimage->id !== null)
                                        <div class="uploaded-img">
                                            <p>※アップロード済み画像があります。変更する場合のみ、再度アップロードしてください。</p>
                                            <img src="{{ $topimage->baseFilePath . $topimage->id }}/{{ $topimage->baseFileName }}.{{ $topimage->extention }}">
                                        </div>
                                    @endif
                                </div>
                            </div><!-- form-group -->

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
