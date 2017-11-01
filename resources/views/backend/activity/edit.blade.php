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
                        {!! Form::open(['method' => 'post', 'route' => 'activity.store','enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['activity.update', $activity],'enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
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
                                <label for="photo1" class="col-sm-3 control-label">画像</label>
                                <div class="col-sm-9">

                                    <div class="image-add-box" id="imageUpload">
                                        <i class="fa fa-plus"></i>
                                    </div>

                                    @if($errors->has('activity'))
                                        <span class="help-block">
                                            <strong class="text-danger">{{ $errors->first('activity') }}</strong>
                                        </span>
                                    @endif

                                    {{--@if($activity->id !== null)--}}
                                    {{--<div class="uploaded-img">--}}
                                    {{--<p>※アップロード済み画像があります。変更する場合のみ、再度アップロードしてください。</p>--}}
                                    {{--<img src="{{ $activity->baseFilePath . $activity->id }}/{{ $activity->baseFileName }}.{{ $activity->extention }}">--}}
                                    {{--</div>--}}
                                    {{--@endif--}}

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


    {{-- 削除確認 Modal --}}
    <div class="modal fade" id="confirm-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="fa fa-warning"></i> Alert</h4>
                </div>
                <div class="modal-body">
                    <p>削除してもよろしいですか？</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                    <button type="button" class="btn btn-danger">削除する</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection

@section('js')
    <script src="/backend/js/use-ckeditor.js"></script>
    <script>
        $(function () {
            $("#imageUpload").dropzone({url: "{{ route('activity.store') }}"});

            Dropzone.options.imageUpload = {
                dictDefaultMessage: 'アップロードするファイルをここへドロップしてください',
                acceptedFiles: '.jpg, .jpeg, .gif, .png',
                maxFilesize: 5, // 5MBまで
                method: 'POST',
//                accept: function(file, done) {
//                    if (file.name == "justinbieber.jpg") {
//                        done(file.name);
//                        console.log(file.name);
//                    }
//                    else {
//                        done(file.name);
//                        console.log(file.name);
//                    }
//                }
            }
        });
    </script>
@endsection
