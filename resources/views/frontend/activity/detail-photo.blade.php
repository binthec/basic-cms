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

                    @include('frontend.activity.timetable', ['actSingle' => $actSingle])

                    @if($actSingle->detail !== null)
                        <div class="post">{!! $actSingle->detail !!}</div>
                    @endif

                </div><!-- /.col -->
            </div><!-- /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="grid">
                        @foreach($actSingle->pictures as $pict)
                            <img class="grid-item" src="{{ $pict->getPictPath(\App\Activity::class, \App\Activity::$pictPrefix) }}">
                        @endforeach
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->

            @include('frontend.activity.small-list')
            @include('frontend.activity.see-more')

        </div><!-- /.container -->
    </section>
@endsection

@section('css')
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/component.css"/>
    <link rel="stylesheet" href="/vendor/vertical-timeline/css/default.css"/>
@endsection

@section('js')
    <script src="/vendor/masonry.masonry.pkgd.js"></script>
    <script>
        $('.grid').masonry({
            itemSelector: '.grid-item',
            columnWidth: 200
        });
    </script>
@endsection