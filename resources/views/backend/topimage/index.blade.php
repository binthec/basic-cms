@extends('backend.layouts.app')

@section('content')
    <article class="content">
        <div class="title-block">
            <h3 class="title"> トップ画像一覧 </h3>
            <p class="title-description"> トップ画面のスライダーに表示される画像の一覧です。ミニアイコンにマウスポインタを乗せると、画像を拡大して見ることが出来ます。</p>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-block sameheight-item">

                        @if($topimages->count() > 0)
                            <table class="table table-bordered with-btn">
                                <thead>
                                <tr class="bg-primary text-center">
                                    <th width="5%">ID</th>
                                    <th width="10%">ステータス</th>
                                    <th>サムネイルと名前</th>
                                    <th width="5%">編集</th>
                                    <th width="5%">削除</th>
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
                                            <img src="{{ $image->filePath . $image->id . '/original.' . $image->extention }}" height="38px" data-lity class="cursor-zoomIn">
                                            {{ $image->name }}
                                        </td>
                                        <td><a class="btn btn-primary-outline" href="{{ route('topimage.edit', $image->id) }}">編集</a></td>
                                        <td><a class="btn btn-danger-outline">削除</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <i class="fa fa-warning"></i> トップ画像が存在しません。
                        @endif

                        @if($topimages->count() > 0)
                            {{ $topimages->links() }}
                        @endif

                    </div><!-- /.card -->
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </section>
    </article>
@endsection
