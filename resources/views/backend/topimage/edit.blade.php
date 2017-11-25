@extends('backend.layouts.app')
@section('bodyId', 'topimage-edit')

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
                                        @if($topimage->id !== null && $topimage->status === \App\Topimage::OPEN)
                                            {{ Form::radio('status', \App\Topimage::OPEN, true, ['class' => 'flat-blue']) }} 公開
                                        @else
                                            {{ Form::radio('status', \App\Topimage::OPEN, '', ['class' => 'flat-blue']) }} 公開
                                        @endif
                                    </label>
                                    <label class="radio-inline">
                                        @if($topimage->id === null || $topimage->status === \App\Topimage::CLOSE)
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
                                <label for="act-pict-tmp" class="col-sm-3 control-label">画像</label>
                                <div class="col-sm-9">

                                    <div class="pict-add-box" id="pictUpload">
                                        <i class="fa fa-image"> ファイルをドロップするか、ここをクリックしてください</i>
                                    </div>

                                    <div id="pict-preview-box" class="text-center">
                                        @if($topimage->id !== null)
                                            <div class="uploaded-preview">
                                                <div class="uploaded-img">
                                                    <img src="{{ $topimage->pictures->first()->getPictPath(\App\Topimage::class) }}">
                                                </div>
                                                <a href="javascript: undefined;" class="remove" data-act-id="{{ $topimage->id }}" data-pict-id="{{ $pict->id }}" data-pict-name="{{ $pict->name }}">削除</a>

                                                <span class="pict-input-box">
                                                    {{ Form::hidden('topimage', $pict->name) }}
                                                </span>
                                            </div><!-- /.uploaded-preview -->
                                        @endif
                                    </div>

                                    @if($errors->has('topimage'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('topimage') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- /.col-sm-9 -->
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



@section('js')
    @include('backend/parts/func-dz', ['className' => 'topimage'])
    <script>
        $(function () {
            // Disabling autoDiscover, otherwise Dropzone will try to attach twice. だそうな。
            Dropzone.autoDiscover = false;

            var Topimage = new Dropzone('#pictUpload', { //Dropzoneインスタンスを生成
                url: "{{ route('topimage.pict.store') }}", //送信先
                method: 'POST',
                uploadMultiple: false, //複数アップロードを許可するか
                acceptedFiles: '.jpg, .jpeg, .gif, .png',
                maxFilesize: 8, // 8MBまで
                addRemoveLinks: true,
                dictRemoveFile: '削除',
                thumbnailWidth: 360,
                thumbnailHeight: 240,
                maxFile: 1, // ファイル１つまで…？にならない：TODO

                init: getDZInit('topimage', 'topimage'),
            });
        });
    </script>
@endsection
