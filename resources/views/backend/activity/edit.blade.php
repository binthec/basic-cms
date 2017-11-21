@extends('backend.layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>活動の様子{{ ($activity->id === null)? '新規登録' : '編集' }}</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 「活動の様子」に表示される記事を{{ ($activity->id === null)? '新規登録' : '編集' }}します。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    @if($activity->id === null)
                        {!! Form::open(['method' => 'post', 'route' => 'activity.store', 'files'=> true, 'class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['activity.update', $activity], 'files'=> true, 'class' => 'form-horizontal']) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="box box-info">

                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>

                        <div class="box-body">

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-sm-3 control-label">記事の名前 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('title', ($activity->id !== null)? $activity->title: '', ['id' => 'name', 'class' => 'form-control', 'placeholder' => '記事のタイトル']) }}

                                    @if($errors->has('title'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('title') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                <label for="date" class="col-sm-3 control-label">開催日 <span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    {!! Form::text('date', ($activity->id !== null)? getNormalDateFromStd($activity->date) : '', ['class' => 'form-control use-datepicker', 'placeholder' => 'yyyy/mm/dd']) !!}

                                    @if($errors->has('date'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('date') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
                                <label for="place" class="col-sm-3 control-label">開催場所 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('place', ($activity->id !== null)? $activity->place: '', ['id' => 'place', 'class' => 'form-control', 'placeholder' => '開催した場所や地域名、会場名など']) }}

                                    @if($errors->has('place'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('place') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                                <label for="detail" class="col-sm-3 control-label">内容</label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('detail', ($activity->id !== null)? $activity->detail: '', ['class' => 'form-control', 'id' => 'use-ckeditor']) !!}

                                    @if($errors->has('detail'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('detail') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                                <label for="act-pict-tmp" class="col-sm-3 control-label">画像</label>
                                <div class="col-sm-9">

                                    <div class="pict-add-box" id="pictUpload">
                                        <i class="fa fa-image"> ファイルをドロップするか、ここをクリックしてください</i>
                                    </div>

                                    <div id="pict-preview-box">
                                        @if($activity->id !== null)
                                            @forelse($activity->pictures as $pict)
                                                <div class="uploaded-preview">
                                                    <div class="uploaded-img">
                                                        <img src="{{ $pict->getPictPath(\App\Activity::class, \App\Activity::$pictPrefix) }}">
                                                    </div>
                                                    <a href="javascript: undefined;" class="remove" data-act-id={{ $activity->id }} data-pict-id="{{ $pict->id }}" data-pict-name="{{ $pict->name }}">削除</a>

                                                    <span class="pict-input-box">
                                                        {{ Form::hidden('pictures[]', $pict->name) }}
                                                    </span>
                                                </div><!-- /.uploaded-preview -->

                                            @empty
                                            @endforelse
                                        @endif
                                    </div>

                                    @if($errors->has('activity'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('activity') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- /.col-sm-9 -->
                            </div><!-- form-group -->

                            <hr>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-sm-3 control-label">公開ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if($activity->id !== null && $activity->status === \App\Activity::OPEN)
                                            {{ Form::radio('status', \App\Activity::OPEN, true, ['class' => 'flat-blue']) }} 公開
                                        @else
                                            {{ Form::radio('status', \App\Activity::OPEN, '', ['class' => 'flat-blue']) }} 公開
                                        @endif
                                    </label>
                                    <label class="radio-inline">
                                        @if($activity->id === null || $activity->status === \App\Activity::CLOSE)
                                            {{ Form::radio('status', \App\Activity::CLOSE, true, ['class' => 'flat-blue']) }} 非公開
                                        @else
                                            {{ Form::radio('status', \App\Activity::CLOSE, '', ['class' => 'flat-blue']) }} 非公開
                                        @endif
                                    </label>

                                    @if($errors->has('status'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('status') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">登　録</button>
                            </div>
                        </div>

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->
    </div><!-- ./content-wrapper -->

@endsection

@section('js')
    <script src="/backend/js/use-ckeditor.js"></script>
    <script>
        $(function () {

            // Disabling autoDiscover, otherwise Dropzone will try to attach twice. だそうな。
            Dropzone.autoDiscover = false;

            var actPict = new Dropzone('#pictUpload', { //Dropzoneインスタンスを生成
                url: "{{ route('activity.pict.store') }}", //送信先
                method: 'POST',
                uploadMultiple: false, //複数アップロードを許可するか
                acceptedFiles: '.jpg, .jpeg, .gif, .png',
                maxFilesize: 8, // 8MBまで
                addRemoveLinks: true,
                dictRemoveFile: '削除',
                thumbnailWidth: 120,
                thumbnailHeight: 80,

//                previewTemplateContainer: document.querySelector('#preview-template').innerHTML,

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
                        $(file.previewTemplate).append("<input type=hidden name=pictures[] value=" + res.fileName + ">"); //フォームを追加
                    });

                    this.on("removedfile", function (file) { //削除が成功した際の処理

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('activity.pict.delete', true) }}",
                            data: {fileName: file.serverFileName},
                            dataType: 'json',
                            success: function (res) {
                                $('.pict-input-box input').val(file.serverFileName).remove();
                            },
                            error: function (res) {
                                console.log('error!'); //TODO
                            }
                        });
                    });
                }
            });

            $('.uploaded-preview .remove').on('click', function () { //アップロード済画像の削除リンク押した時
                $.ajax({
                    type: 'POST',
                    url: "{{ route('activity.pict.delete') }}",
                    data: {
                        actId: $(this).attr('data-act-id'),
                        pictId: $(this).attr('data-pict-id'),
                        fileName: $(this).attr('data-pict-name'),
                    },
                    context: this, //自身をajaxの中に渡す
                    success: function (res) {
                        $(this).parent('div').remove();
                    },
                    error: function (res) {
                        console.log('error!'); //TODO
                    }
                });
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

            /**
             *  jQueryUI sortable
             */
            $("#pict-preview-box").sortable();
            $("#pict-preview-box").disableSelection();
        });
    </script>
@endsection
