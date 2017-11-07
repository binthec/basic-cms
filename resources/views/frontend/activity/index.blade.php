@extends('frontend.layouts.app')

@section('bodyId', 'act-index')

@section('content')
    <section id="act">
        <div class="container">

            @include('frontend.activity.small-list')

            @if($activities->count() > 0)
                <div class="section-footer">
                    {{ $activities->links() }}
                </div>
            @endif

        </div><!-- /.container -->
    </section>
@endsection
