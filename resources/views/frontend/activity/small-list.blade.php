<div class="section-header">
    <h2 class="section-title text-center wow fadeInDown">{{ isset($singleAct)? 'その他の記事' : '活動の様子 一覧' }}</h2>
    @if(!isset($singleAct))
        <p class="text-center wow fadeInDown">最近の活動の一覧です。</p>
    @endif
</div>

<div class="act-list">
    @foreach($activities as $act)
        <div class="small-post">

            <img src="{{ $act->getMainPictPath() }}" class="thum">

            <div class="post-text">
                <h5 class="entry-title">{{ $act->title }}</h5>
                <p>
                    <span class="date">{{ getJaDate($act->date) }}</span><span class="place">{{ $act->place }}</span>
                </p>
            </div><!-- /.post-text -->

            <a class="read-more" href="{{ route('front.act.detail', $act) }}">読む</a>

        </div><!-- /.small-post -->
    @endforeach
</div><!-- /.act-list -->