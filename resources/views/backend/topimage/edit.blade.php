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
                                <label for="topimage"
                                       class="col-sm-3 control-label">画像{!! ($topimage->id === null)? ' <span class="text-danger">*</span>' : '' !!}</label>
                                <div class="col-sm-9">

                                    <div class="pict-add-box" id="pictUpload">
                                        <i class="fa fa-image"> ファイルをドロップするか、ここをクリックしてください</i>
                                    </div>
                                    <span class="help-block pull-right">
                                        <p class="text-warning">※高さ600px以上の画像推奨</p>
                                        @if($errors->has('topimage'))
                                            <strong class="text-danger">{{ $errors->first('topimage') }}</strong>
                                        @endif
                                    </span>

                                    <div id="pict-preview-box">
                                        @if($topimage->id !== null)
                                            <div class="uploaded-img">
                                                <img src="{{ App\Topimage::$baseFilePath . $topimage->id }}/{{ $topimage->pictures->first()->name }}">
                                            </div>
                                        @endif
                                    </div>

                                    <div id="pict-input-box">
                                        {{ Form::hidden('topimage', ($topimage->id !== null)? $topimage->pictures->first()->name : '') }}
                                    </div>

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

@section('js')
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
                maxFile: 1, // ファイル１つまで…？にならない：TODO
                addRemoveLinks: true,
                dictRemoveFile: '削除',

                init: function () {

                    this.on("addedfile", function (file) { //ファイルを追加した際の処理
                        //プレビューエリアにプレビューを追加
                        $('#pict-preview-box').append(file.previewTemplate);
                    });

                    this.on("sending", function (file, xhr, formData) { //ファイル送信時の処理
                        file.baseFileName = getBaseFileName(); //ユニークな名前を生成
                        formData.append('baseFileName', file.baseFileName);
                    });

                    this.on("success", function (file, res) { //アップロードが成功した際の処理
                        file.serverFileName = res.fileName; //サーバに保存してあるファイル名（拡張子付）

                        //フォームにファイル名を追加
                        $("#pict-input-box input").val(res.fileName);
                    });

                    this.on("removedfile", function (file) { //削除が成功した際の処理

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('topimage.pict.delete') }}",
                            data: {fileName: file.serverFileName},
                            dataType: 'json',
                            success: function (res) {
                                $('#pict-input-box input').val('');
                            },
                            error: function (res) {
                                console.log('error!'); //TODO
                            }
                        });
                    });
                }
            });

            /**
             * ユニークなファイル名を返すメソッド
             *
             * @param myStrong
             * @returns {string}
             */
            function getBaseFileName(myStrong) {
                var strong = 1000;
                if (myStrong) strong = myStrong;
                return new Date().getTime().toString(16) + Math.floor(strong * Math.random()).toString(16)
            }


        });
    </script>
@endsection
