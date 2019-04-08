@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Events
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"> Home</a></li>
                <li class="active">Event</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.message.flash')
            <div class="row">
                <div class="col-md-12" id="listing">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Events</h3>
                        </div>
                        <div class="box-body">
                            @if(!count($events)<=0)
                                <div class="table-responsive">
                                    <table id="example1"
                                           class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Event Name</th>
                                            <th>Event Details</th>
                                            <th>Date</th>
                                            <th>Organizer</th>
                                            <th style="width: 70px;" class="text-right">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($events as $event)
                                            <tr>
                                                <th scope=row>{{$i++}}</th>
                                                <td>{{$event->event_name}}</td>
                                                <td>{{$event->details}}</td>
                                                <td>{{$event->event_date}}</td>
                                                <td>{{$event->organizer->name}}</td>
                                                <td class="text-right">

                                                    @if($event->status == 'active')
                                                        <a class="label label-success stat"
                                                           href="{{url('admin/event/status',$event->id)}}">
                                                            <strong class="stat"> Active
                                                            </strong>
                                                        </a>

                                                    @elseif($event->status == 'inactive')
                                                        <a class="label label-danger stat"
                                                           href="{{url('admin/event/status',$event->id)}}">
                                                            <strong class="stat">Inactive
                                                            </strong>
                                                        </a>
                                                    @endif



                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="col-md-12">
                                    <label class="form-control label-danger">No records found</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection