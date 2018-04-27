@extends('backend.layouts.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>活動の様子を{{ ($activity->id === null)? '新規登録' : '編集' }}</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> 「活動の様子」に表示される記事を{{ ($activity->id === null)? '新規登録' : '編集' }}します。
            </p>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('activity.index') }}">活動の様子一覧</a></li>
                <li class="active">活動の様子を{{ ($activity->id === null)? '新規登録' : '編集' }}</li>
            </ol>
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
                                    {{ Form::text('title', $activity->title, ['id' => 'name', 'class' => 'form-control', 'placeholder' => '記事のタイトル']) }}

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
                                    {!! Form::text('date', ($activity->id !== null)? getNormalDateFromStd($activity->date) : $activity->date, ['class' => 'form-control use-datepicker', 'placeholder' => 'yyyy/mm/dd']) !!}

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
                                    {{ Form::text('place', $activity->place, ['id' => 'place', 'class' => 'form-control', 'placeholder' => '開催した場所や地域名、会場名など']) }}

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
                                    {!! Form::textarea('detail', $activity->detail, ['class' => 'form-control', 'id' => 'use-ckeditor']) !!}

                                    @if($errors->has('detail'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('detail') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('pictures') ? ' has-error' : '' }}">
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

                                    @if($errors->has('pictures'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('pictures') }}</strong>
                                        </span>
                                    @endif
                                </div><!-- /.col-sm-9 -->
                            </div><!-- form-group -->

                            <hr>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-sm-3 control-label">公開ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if(old('status') == \App\Activity::OPEN)
                                            {{ Form::radio('status', \App\Activity::OPEN, '', ['class' => 'flat-blue', 'checked']) }}
                                        @elseif($activity->id !== null && $activity->status === \App\Activity::OPEN)
                                            {{ Form::radio('status', \App\Activity::OPEN, true, ['class' => 'flat-blue']) }}
                                        @else
                                            {{ Form::radio('status', \App\Activity::OPEN, '', ['class' => 'flat-blue']) }}
                                        @endif
                                         公開
                                    </label>
                                    <label class="radio-inline">
                                        @if(old('status') == \App\Activity::CLOSE)
                                            {{ Form::radio('status', \App\Activity::CLOSE, '', ['class' => 'flat-blue', 'checked']) }}
                                        @elseif($activity->id === null || $activity->status === \App\Activity::CLOSE)
                                            {{ Form::radio('status', \App\Activity::CLOSE, true, ['class' => 'flat-blue']) }}
                                        @else
                                            {{ Form::radio('status', \App\Activity::CLOSE, '', ['class' => 'flat-blue']) }}
                                        @endif
                                         非公開
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
    @include('backend/parts/func-dz', ['className' => 'activity'])
    <script src="/backend/js/use-ckeditor.js"></script>
    <script>
        $(function () {
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
                dictCancelUpload: 'アップロードをキャンセル',

                init: getDZInit('pictures[]', 'activity')
            });

            /**
             *  jQueryUI sortable
             */
            $("#pict-preview-box").sortable();
            $("#pict-preview-box").disableSelection();
        });
    </script>
@endsection
