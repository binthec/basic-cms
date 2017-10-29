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

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">名前 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {{ Form::text('name', ($activity->id !== null)? $activity->name: '', ['id' => 'name', 'class' => 'form-control']) }}

                                    @if($errors->has('name'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('name') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content" class="col-sm-3 control-label">内容 <span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    {!! Form::textarea('content', '', ['class' => 'form-control', 'id' => 'use-ckeditor']) !!}

                                    @if($errors->has('content'))
                                        <span class="help-block">
							            <strong class="text-danger">{{ $errors->first('content') }}</strong>
						            </span>
                                    @endif
                                </div>
                            </div><!-- form-group -->

                            <div class="form-group{{ $errors->has('activity') ? ' has-error' : '' }}">
                                <label for="activity" class="col-sm-3 control-label">
                                    画像{!! ($activity->id === null)? ' <span class="text-danger">*</span>' : '' !!}
                                </label>
                                <div class="col-sm-9">

                                    <span class="help-block">
                                    <p class="text-warning">※高さ600px以上の画像推奨</p>
                                        @if($errors->has('activity'))
                                            <strong class="text-danger">{{ $errors->first('activity') }}</strong>
                                        @endif
                                </span>

                                    @if($activity->id !== null)
                                        <div class="uploaded-img">
                                            <p>※アップロード済み画像があります。変更する場合のみ、再度アップロードしてください。</p>
                                            <img src="{{ $activity->baseFilePath . $activity->id }}/{{ $activity->baseFileName }}.{{ $activity->extention }}">
                                        </div>
                                    @endif
                                </div><!-- /.col-sm-9 -->
                            </div><!-- form-group -->
                            <!-- radio -->

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="activity" class="col-sm-3 control-label">ステータス <span class="text-danger">*</span></label>
                                <div class="col-sm-9">

                                    <label class="radio-inline">
                                        @if($activity->id === null || $activity->status === \App\Activity::OPEN)
                                            {{ Form::radio('status', \App\Activity::OPEN, true, ['class' => 'flat-blue']) }} 公開
                                        @else
                                            {{ Form::radio('status', \App\Activity::OPEN, '', ['class' => 'flat-blue']) }} 公開
                                        @endif
                                    </label>

                                    <label class="radio-inline">
                                        @if($activity->id !== null && $activity->status === \App\Activity::CLOSE)
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

                            <hr>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">登　録</button>
                                </div>
                            </div><!-- form-group -->

                        </div><!-- /.box-body -->

                    </div><!-- /.box -->

                    {!! Form::close() !!}

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->

    </div><!-- ./content-wrapper -->

    <div class="modal fade" id="modal-media">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">画像のアップロード</h4>
                </div>
                <div class="modal-body">
                    <div class="modal-tab-content">
                        <div class="" id="upload">
                            <div class="upload-container">
                                <div id="dropzone">
                                    <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable"
                                          id="demo-upload">
                                        <div class="dz-message-block">
                                            <div class="dz-message needsclick"> ファイルをドロップするか、ここをクリックしてファイルを選択してください</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                    <button type="button" class="btn btn-primary">選択した画像を追加</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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

    <div class="box-footer">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">登　録</button>
        </div>
    </div><!-- /.box-footer -->

@endsection

@section('js')
    <script src="/backend/js/use-ckeditor.js"></script>
@endsection
