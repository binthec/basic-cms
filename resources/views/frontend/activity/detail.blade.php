@extends('frontend.layouts.app')

@section('bodyId', 'act-detail')

@section('content')
    <section id="act">
        <div class="container">

            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">{{ $actSingle->title }}</h2>
                <p class="text-center wow fadeInDown">
                    <span class="entry-date">{{ getJaDate($actSingle->date) }}</span>
                    <span class="entry-place">於&ensp;{{ $actSingle->place }}</span>
                </p>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="act-picts">
                        @foreach($actSingle->pictures as $pict)
                            <img src="{{ $pict->getPictPath(\App\Activity::class, \App\Activity::$pictPrefix) }}">
                        @endforeach
                    </div>

                    @if(!empty($actSingle->timetable))
                        <div class="timetable">
                            <header class="clearfix">
                                <span>Programm</span>
                                <h1>プログラムの流れ</h1>
                            </header>
                            <div class="main">
                                <ul class="cbp_tmtimeline">

                                    @foreach($actSingle->timetable as $timetable)
                                        <li>
                                            @if(!empty($timetable['time']))
                                                <time class="cbp_tmtime" datetime="{{ $timetable['time'] }}}">
                                                    <span>{{ getMdDate($actSingle->date) }}</span> <span>{{ $timetable['time'] }}</span>
                                                </time>
                                            @endif
                                            <div class="cbp_tmicon cbp_tmicon-earth"></div>
                                            <div class="cbp_tmlabel">
                                                <h2>{{$timetable['action']}}</h2>
                                                {{--<p>テキストテキスト</p>--}}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!-- /.container -->
                    @endif

                    <div class="post">{!! $actSingle->detail !!}</div>

                </div><!-- /.col -->
            </div><!-- /.row -->

            @include('frontend.activity.small-list')

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
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/component.css"/>
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/default.css"/>
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
    <script src="/vendor/vertical-timeline/js/modernizr.custom.js"></script>
@endsection