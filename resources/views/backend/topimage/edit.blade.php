@extends('backend.layouts.app')

@section('content')
    <article class="content">
        <div class="title-block">
            <h3 class="title"> トップ画像{{ ($topimage->id === null)? '新規登録' : '編集' }} </h3>
            <p class="title-description"> トップページのスライダーに表示する画像を{{ ($topimage->id === null)? '新規登録' : '編集' }}します。 </p>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-block sameheight-item">
                        <div class="title-block">
                            <h3 class="title"><i class="fa fa-edit"></i> 入力してください </h3>
                        </div>

                        @if($topimage->id === null)
                            {!! Form::open(['method' => 'post', 'route' => 'topimage.store','enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                        @else
                            {!! Form::open(['method' => 'put', 'route' => ['topimage.update', $topimage],'enctype'=> 'multipart/form-data','class' => 'form-horizontal']) !!}
                        @endif
                        {{ csrf_field() }}

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
                            <label for="topimage" class="col-sm-3 control-label">ステータス <span class="text-danger">*</span></label>
                            <div class="col-sm-9 radio-inline">
                                <label>
                                    @if($topimage->id === null || $topimage->status === \App\Topimage::OPEN)
                                        {{ Form::radio('status', \App\Topimage::OPEN, true, ['class' => 'radio']) }}<span>公開</span>
                                    @else
                                        {{ Form::radio('status', \App\Topimage::OPEN, '', ['class' => 'radio']) }}<span>公開</span>
                                    @endif
                                </label>
                                <label>
                                    @if($topimage->id !== null && $topimage->status === \App\Topimage::CLOSE)
                                        {{ Form::radio('status', \App\Topimage::CLOSE, true, ['class' => 'radio']) }}<span>非公開</span>
                                    @else
                                        {{ Form::radio('status', \App\Topimage::CLOSE, '', ['class' => 'radio']) }}<span>非公開</span>
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

                        <hr>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success">登　録</button>
                            </div>
                        </div><!-- form-group -->

                        {!! Form::close() !!}

                    </div>
                </div>
            </div><!-- /.row -->
        </section>
    </article>
@endsection
