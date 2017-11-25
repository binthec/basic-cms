@extends('backend.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>カレンダー
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Calendar</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">教室日を追加</h3>
                        </div>
                        <div class="box-body">
                            {!! Form::open(['method' => 'POST', 'route' => 'event.store']) !!}
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="タイトル">
                            </div>
                            <div class="form-group">
                                <input type="text" name="date" class="form-control use-datepicker" placeholder="日付">
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-flat">追加</button>
                            </div>

                            {!! Form::close() !!}

                        </div><!-- /.box-body -->


                    </div>
                </div><!-- /.col -->

                <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-body no-padding">
                            <div id="calendar"></div>
                        </div>
                    </div><!-- /. box -->
                </div><!-- /.col -->

            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">
                        教室日程「<span id="school-title"></span>」を　編集 or 削除する
                    </h4>
                </div>


                <div class="modal-body">


                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="タイトル">
                    </div>
                    <div class="form-group">
                        <input type="text" name="date" class="form-control use-datepicker" placeholder="日付">
                    </div>

                    <div class="clearfix">
                        {!! Form::open(['method' => 'DELETE', 'url' => '', 'id' => 'destroy-form']) !!}
                        <button type="submit" class="btn btn-danger pull-left">削除する</button>
                        {!! Form::close() !!}

                        {!! Form::open(['method' => 'PUT', 'url' => '', 'id' => 'update-form']) !!}
                        <button type="submit" class="btn btn-primary btn-flat pull-right">編集実行</button>
                        {!! Form::close() !!}

                        <div class="pull-right">
                            &ensp;&ensp;
                        </div>

                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">キャンセル</button>
                    </div>

                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    {{--{{dd($events)}}--}}
@endsection

@section('js')
    <script>
        $(function () {
            var calendar = $('#calendar').fullCalendar({
                buttonText: {
                    today: '今日',
                },
                events: [
                        @foreach($events as $id => $event)
                    {
                        id: "{{ $id }}",
                        title: "{{ $event['title'] }}",
                        start: "{{ $event['start'] }}",
                        start: "{{ $event['end'] }}",
                        allDay: true,
                    },
                    @endforeach
                ],
                dayClick: function (date, jsEvent, view, resourceObj) {

                    alert('Date: ' + date.format());
                    alert('Resource ID: ' + resourceObj.id);

                },
                eventClick: function (calEvent, jsEvent, view) {
                    var myModal = $('#modal-edit').modal();
                    $('#modal-edit').find('#school-title').text(calEvent.title);

                    $('#modal-edit').find('#update-form').attr('action', '/event/' + calEvent.id);
                    $('#modal-edit').find('input[name=title]').val(calEvent.title);

                    $('#modal-edit').find('#destroy-form').attr('action', '/event/' + calEvent.id);
                    $('#modal-edit').find('input[name=date]').val(calEvent.start);
                }
            });
        });
    </script>
@endsection