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
                    <div class="post">
                        {!! $singleAct->detail !!}
                    </div>
                </div>

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
