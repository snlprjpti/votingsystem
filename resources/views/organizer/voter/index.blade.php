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
                            @if(!count($voters)<=0)
                                <div class="table-responsive">
                                    <table id="example1"
                                           class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th style="width: 50px">Can Vote?</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($voters as $voter)
                                            <tr>
                                                <th scope=row>{{$i++}}</th>
                                                <td>{{$voter->name}}</td>
                                                <td>{{$voter->email}}</td>
                                                <td>
                                                    @if($voter->can_vote == 'yes')
                                                        <a href="{{url('organizer/voter/status',$voter->id)}}" class="btn btn-sm btn-success">Yes</a>
                                                    @else
                                                        <a href="{{url('organizer/voter/status',$voter->id)}}" class="btn btn-sm btn-danger">No</a>
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