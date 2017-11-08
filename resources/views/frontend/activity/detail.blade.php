@extends('frontend.layouts.app')

@section('bodyId', 'act-detail')

@section('content')
    <section id="act">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">{{ $singleAct->title }}</h2>
                <p class="text-center wow fadeInDown">
                    <span class="entry-date">{{ getJaDate($singleAct->date) }}</span>
                    <span class="entry-place">於&ensp;{{ $singleAct->place }}</span>
                </p>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="act-picts">
                        @foreach($singleAct->pictures as $pict)
                            <div><img src="{{ $pict->getPictPath(\App\Activity::class, \App\Activity::$pictPrefix) }}"></div>
                        @endforeach
                    </div>

                    <div class="post">{!! $singleAct->detail !!}</div>

                </div><!-- /.col -->
            </div><!-- /.row -->

            @if($activities->count() > 0)
                @include('frontend.activity.small-list')
            @endif

            <div class="section-footer">
                <div class="wow fadeInLeft">
                    <a href="{{ route('front.act.index') }}" class="btn btn-primary">もっと見る</a>
                </div>
            </div><!-- /.section-footer -->


        </div><!-- /.container -->
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/slick/slick.css"/>
    <link rel="stylesheet" href="/vendor/slick/slick-theme.css"/>
@endsection

@section('js')
    <script src="/vendor/slick/slick.min.js"></script>
    <script>
        //Slider
        $('.act-picts').slick({
            dots: true,
            infinite: true,
            centerMode: true,
            autoplay: true,
            variableWidth: true,
            autoplaySpeed: 3000,
        });
    </script>
@endsection