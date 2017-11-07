@extends('backend.layouts.app')

@section('css')
    <link rel="stylesheet" href="/vendor/lity/lity.min.css">
@endsection

@section('js')
    <script src="/vendor/lity/lity.min.js"></script>
@endsection

@section('content')

    <div class="content-wrapper">

        <section class="content-header">
            <h1>トップ画像一覧</h1>
            <p class="content-description">
                <i class="fa fa-info-circle"></i> トップ画面のスライダーに表示される画像の一覧です。ミニアイコンにマウスポインタを乗せると、画像を拡大して見ることが出来ます。
            </p>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">

                        <div class="box-body">
                            @if($topimages->count() > 0)
                                <table class="table table-bordered with-btn">
                                    <thead>
                                    <tr class="bg-primary text-center">
                                        <td width="5%">ID</td>
                                        <td width="10%">ステータス</td>
                                        <td>サムネイルと名前</td>
                                        <td width="5%">編集</td>
                                        <td width="5%">削除</td>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($topimages as $image)
                                        <tr>
                                            <td class="text-center">{{ $image->id }}</td>
                                            <td class="text-center">
                                                <label class="label label-lg {{ ($image->status === 1)? 'label-info' : 'label-danger' }}">
                                                    {{ \App\Topimage::$statusList[$image->status] }}
                                                </label>
                                            </td>
                                            <td>
                                                <img src="{{ $image->getPictPath() }}" height="38px" data-lity class="cursor-zoomIn">
                                                {{ $image->name }}
                                            </td>
                                            <td><a class="btn btn-primary" href="{{ route('topimage.edit', $image->id) }}">編集</a></td>
                                            <td>
                                                <a class="btn btn-danger" data-toggle="modal" data-target="#destroy{{ $image->id }}">削除</a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="destroy{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="modal">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="myModalLabel">削除実行してよろしいですか？</h4>
                                                            </div>
                                                            <div class="modal-body clearfix">
                                                                <div>
                                                                    <p><i class="fa fa-image"></i> 選択したトップ画像：「{{ $image->name }}」</p>
                                                                    <img src="{{ $image->baseFilePath . $image->id }}/{{ $image->baseFileName }}.{{ $image->extention }}"
                                                                         height="100px">
                                                                </div>
                                                                <div class="help-block pull-right">
                                                                    <p class="text-danger"><i class="fa fa-warning"></i>この処理は取り消せません。</p>
                                                                </div>
                                                            </div>
                                                            {!! Form::open(['method' => 'delete', 'route' => ['topimage.destroy', $image->id]]) !!}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary-outline" data-dismiss="modal">キャンセル</button>
                                                                <button type="submit" class="btn btn-danger">削除実行</button>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal -->
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <i class="fa fa-warning"></i> トップ画像が存在しません。
                            @endif

                        </div><!-- /.box-body -->

                        @if($topimages->hasMorePages())
                            <div class="box-footer text-center">
                                {{ $topimages->links() }}
                            </div>
                        @endif

                    </div><!-- /.box -->

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section>

    </div><!-- ./content-wrapper -->

@endsection
