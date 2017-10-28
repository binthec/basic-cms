@extends('backend.layouts.app')

@section('content')

    <article class="content">
        <div class="title-block">
            <h3 class="title"> 活動の様子{{ ($activity->id === null)? '新規登録' : '編集' }} </h3>
            <p class="title-description"> トップ画面の「活動の様子」に表示される記事を{{ ($activity->id === null)? '新規登録' : '編集' }}します。 </p>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">

                    @if($activity->id === null)
                        {!! Form::open(['method' => 'post', 'route' => 'activity.store','enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @else
                        {!! Form::open(['method' => 'put', 'route' => ['activity.update', $activity],'enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                    @endif
                    {{ csrf_field() }}

                    <div class="card card-block sameheight-item">
                        <div class="title-block">
                            <h3 class="title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>

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

                                <div class="wyswyg">
                                    <div class="toolbar">
										<span class="ql-format-group">
											<select title="Size" class="ql-size">
												<option value="10px">Small</option>
												<option value="13px" selected>Normal</option>
												<option value="18px">Large</option>
												<option value="32px">Huge</option>
											</select>
										</span>
                                        <span class="ql-format-group">
											<span title="Bold" class="ql-format-button ql-bold"></span> <span class="ql-format-separator"></span>
											<span title="Italic" class="ql-format-button ql-italic"></span>
											<span class="ql-format-separator"></span>
											<span title="Underline" class="ql-format-button ql-underline"></span>
											<span class="ql-format-separator"></span> <span title="Strikethrough" class="ql-format-button ql-strike"></span>
										</span>
                                        <span class="ql-format-group">
											<select title="Text Color" class="ql-color">
												<option value="rgb(0, 0, 0)" label="rgb(0, 0, 0)" selected></option>
												<option value="rgb(230, 0, 0)" label="rgb(230, 0, 0)"></option>
												<option value="rgb(255, 153, 0)" label="rgb(255, 153, 0)"></option>
												<option value="rgb(255, 255, 0)" label="rgb(255, 255, 0)"></option>
												<option value="rgb(0, 138, 0)" label="rgb(0, 138, 0)"></option>
												<option value="rgb(0, 102, 204)" label="rgb(0, 102, 204)"></option>
												<option value="rgb(153, 51, 255)" label="rgb(153, 51, 255)"></option>
												<option value="rgb(255, 255, 255)" label="rgb(255, 255, 255)"></option>
												<option value="rgb(250, 204, 204)" label="rgb(250, 204, 204)"></option>
												<option value="rgb(255, 235, 204)" label="rgb(255, 235, 204)"></option>
												<option value="rgb(255, 255, 204)" label="rgb(255, 255, 204)"></option>
												<option value="rgb(204, 232, 204)" label="rgb(204, 232, 204)"></option>
												<option value="rgb(204, 224, 245)" label="rgb(204, 224, 245)"></option>
												<option value="rgb(235, 214, 255)" label="rgb(235, 214, 255)"></option>
												<option value="rgb(187, 187, 187)" label="rgb(187, 187, 187)"></option>
												<option value="rgb(240, 102, 102)" label="rgb(240, 102, 102)"></option>
												<option value="rgb(255, 194, 102)" label="rgb(255, 194, 102)"></option>
												<option value="rgb(255, 255, 102)" label="rgb(255, 255, 102)"></option>
												<option value="rgb(102, 185, 102)" label="rgb(102, 185, 102)"></option>
												<option value="rgb(102, 163, 224)" label="rgb(102, 163, 224)"></option>
												<option value="rgb(194, 133, 255)" label="rgb(194, 133, 255)"></option>
												<option value="rgb(136, 136, 136)" label="rgb(136, 136, 136)"></option>
												<option value="rgb(161, 0, 0)" label="rgb(161, 0, 0)"></option>
												<option value="rgb(178, 107, 0)" label="rgb(178, 107, 0)"></option>
												<option value="rgb(178, 178, 0)" label="rgb(178, 178, 0)"></option>
												<option value="rgb(0, 97, 0)" label="rgb(0, 97, 0)"></option>
												<option value="rgb(0, 71, 178)" label="rgb(0, 71, 178)"></option>
												<option value="rgb(107, 36, 178)" label="rgb(107, 36, 178)"></option>
												<option value="rgb(68, 68, 68)" label="rgb(68, 68, 68)"></option>
												<option value="rgb(92, 0, 0)" label="rgb(92, 0, 0)"></option>
												<option value="rgb(102, 61, 0)" label="rgb(102, 61, 0)"></option>
												<option value="rgb(102, 102, 0)" label="rgb(102, 102, 0)"></option>
												<option value="rgb(0, 55, 0)" label="rgb(0, 55, 0)"></option>
												<option value="rgb(0, 41, 102)" label="rgb(0, 41, 102)"></option>
												<option value="rgb(61, 20, 102)" label="rgb(61, 20, 102)"></option>
											</select>
											<span class="ql-format-separator"></span>
                                            <select title="Background Color" class="ql-background">
												<option value="rgb(0, 0, 0)" label="rgb(0, 0, 0)"></option>
												<option value="rgb(230, 0, 0)" label="rgb(230, 0, 0)"></option>
												<option value="rgb(255, 153, 0)" label="rgb(255, 153, 0)"></option>
												<option value="rgb(255, 255, 0)" label="rgb(255, 255, 0)"></option>
												<option value="rgb(0, 138, 0)" label="rgb(0, 138, 0)"></option>
												<option value="rgb(0, 102, 204)" label="rgb(0, 102, 204)"></option>
												<option value="rgb(153, 51, 255)" label="rgb(153, 51, 255)"></option>
												<option value="rgb(255, 255, 255)" label="rgb(255, 255, 255)" selected></option>
												<option value="rgb(250, 204, 204)" label="rgb(250, 204, 204)"></option>
												<option value="rgb(255, 235, 204)" label="rgb(255, 235, 204)"></option>
												<option value="rgb(255, 255, 204)" label="rgb(255, 255, 204)"></option>
												<option value="rgb(204, 232, 204)" label="rgb(204, 232, 204)"></option>
												<option value="rgb(204, 224, 245)" label="rgb(204, 224, 245)"></option>
												<option value="rgb(235, 214, 255)" label="rgb(235, 214, 255)"></option>
												<option value="rgb(187, 187, 187)" label="rgb(187, 187, 187)"></option>
												<option value="rgb(240, 102, 102)" label="rgb(240, 102, 102)"></option>
												<option value="rgb(255, 194, 102)" label="rgb(255, 194, 102)"></option>
												<option value="rgb(255, 255, 102)" label="rgb(255, 255, 102)"></option>
												<option value="rgb(102, 185, 102)" label="rgb(102, 185, 102)"></option>
												<option value="rgb(102, 163, 224)" label="rgb(102, 163, 224)"></option>
												<option value="rgb(194, 133, 255)" label="rgb(194, 133, 255)"></option>
												<option value="rgb(136, 136, 136)" label="rgb(136, 136, 136)"></option>
												<option value="rgb(161, 0, 0)" label="rgb(161, 0, 0)"></option>
												<option value="rgb(178, 107, 0)" label="rgb(178, 107, 0)"></option>
												<option value="rgb(178, 178, 0)" label="rgb(178, 178, 0)"></option>
												<option value="rgb(0, 97, 0)" label="rgb(0, 97, 0)"></option>
												<option value="rgb(0, 71, 178)" label="rgb(0, 71, 178)"></option>
												<option value="rgb(107, 36, 178)" label="rgb(107, 36, 178)"></option>
												<option value="rgb(68, 68, 68)" label="rgb(68, 68, 68)"></option>
												<option value="rgb(92, 0, 0)" label="rgb(92, 0, 0)"></option>
												<option value="rgb(102, 61, 0)" label="rgb(102, 61, 0)"></option>
												<option value="rgb(102, 102, 0)" label="rgb(102, 102, 0)"></option>
												<option value="rgb(0, 55, 0)" label="rgb(0, 55, 0)"></option>
												<option value="rgb(0, 41, 102)" label="rgb(0, 41, 102)"></option>
												<option value="rgb(61, 20, 102)" label="rgb(61, 20, 102)"></option>
											</select>
										</span>
                                        <span class="ql-format-group">
											<span title="List" class="ql-format-button ql-list"></span>
											<span class="ql-format-separator"></span>
											<span title="Bullet" class="ql-format-button ql-bullet"></span>
											<span class="ql-format-separator"></span>
											<select title="Text Alignment" class="ql-align">
												<option value="left" label="Left" selected></option>
												<option value="center" label="Center"></option>
												<option value="right" label="Right"></option>
												<option value="justify" label="Justify"></option>
											</select>
										</span>
                                        <span class="ql-format-group">
											<span title="Link" class="ql-format-button ql-link"></span>
											<span class="ql-format-separator"></span>
											<button type="button" title="Image" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modal-media">
												<i class="fa fa-image"></i> Media
											</button>
										</span>
                                        <span class="ql-format-group">
										</span>
                                    </div>

                                    <!-- Create the editor container -->
                                    <div class="editor"> Hello World</div>
                                </div>

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
                                <div class="images-container">
                                    <div class="image-container">
                                        <div class="controls"><a href="" class="control-btn move"><i class="fa fa-arrows"></i></a>
                                            <a href="" class="control-btn star">
                                                <i class="fa"></i>
                                            </a>
                                            <a href="#" class="control-btn remove" data-toggle="modal" data-target="#confirm-modal">
                                                <i class="fa fa-trash-o"></i>
                                            </a></div>
                                        <div class="image"
                                             style="background-image:url('https://s3.amazonaws.com/uifaces/faces/twitter/brad_frost/128.jpg')"></div>
                                    </div>

                                    {{--追加するボタン--}}
                                    <a href="#" class="add-image" data-toggle="modal" data-target="#modal-media">
                                        <div class="image-container new">
                                            <div class="image"><i class="fa fa-plus"></i></div>
                                        </div>
                                    </a>

                                </div>

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

                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="activity" class="col-sm-3 control-label">ステータス <span class="text-danger">*</span></label>
                            <div class="col-sm-9 radio-inline">
                                <label>
                                    @if($activity->id === null || $activity->status === \App\Activity::OPEN)
                                        {{ Form::radio('status', \App\Activity::OPEN, true, ['class' => 'radio']) }}<span>公開</span>
                                    @else
                                        {{ Form::radio('status', \App\Activity::OPEN, '', ['class' => 'radio']) }}<span>公開</span>
                                    @endif
                                </label>
                                <label>
                                    @if($activity->id !== null && $activity->status === \App\Activity::CLOSE)
                                        {{ Form::radio('status', \App\Activity::CLOSE, true, ['class' => 'radio']) }}<span>非公開</span>
                                    @else
                                        {{ Form::radio('status', \App\Activity::CLOSE, '', ['class' => 'radio']) }}<span>非公開</span>
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

                    </div><!-- /.card -->

                    {!! Form::close() !!}

                </div><!-- /.col-sm-12 -->
            </div><!-- /.row -->

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

        </section>
    </article>


@endsection
