@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Details
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Event</a></li>
                <li class="active">Details</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @include('admin.message.flash')
            <div class="box box-danger">
                <div class="box-header with-border">
                    <a href="{{URL::previous()}}" class="pull-right" data-toggle="tooltip" title="Go Back">
                        <i class="fa fa-arrow-circle-left fa-2x"></i></a>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Details Image -->
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <h3 class="profile-username text-center">Event Title: {{$event->event_name}}</h3>
                                </div>
                            </div>

                            <!-- About Me Box -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">About</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <strong>Details</strong>
                                    <p class="text-muted">
                                        {{$event->details}}
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li id="settings_li" class="active">
                                        <a href="#settings" data-toggle="tab" id="setting_tab">Vote</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="settings">

                                        @if(count($vote) == 0)
                                            <?php  $posts = \App\Repository\OrganizerRepository::getPostByOrganizer(Auth::user()->organizer_id);
                                            ?>

                                            @if(!empty($posts))

                                                @foreach($posts as $post)
                                                    <form action="{{url('voter/event/vote',$event->id)}}" method="post">
                                                        {{csrf_field()}}
                                                        <h4>{{$post->post_name}}</h4>
                                                        <table class="table table-bordered table-hover table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th>Candidates</th>
                                                                <th>Action</th>
                                                            </tr>
                                                            </thead>
                                                            <body>
                                                            <?php

                                                            $candidates = \App\Repository\OrganizerRepository::getCandidateByPost($post->id);
                                                            ?>
                                                            @forelse($candidates as $candidate)
                                                                <tr>
                                                                    <td>{{$candidate->candidate_name}}</td>
                                                                    <td style="width:10px;">
                                                                        <input type="checkbox"
                                                                               value="{{$candidate->id}}"
                                                                               name="vote[{{$post->id}}][]">
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td>No Candidates</td>
                                                                    <td style="width:10px;"></td>
                                                                </tr>
                                                            @endforelse
                                                            </body>
                                                        </table>

                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                        @endforeach
                                                    </form>
                                                    @endif
                                                    @else
                                                        <table class="table table-bordered table-hover table-responsive">
                                                            <thead>
                                                            <tr>
                                                                <th>Post</th>
                                                                <th>Candidate</th>
                                                            </tr>
                                                            </thead>
                                                            @foreach($vote as $v)
                                                                <tbody>
                                                                <tr>
                                                                    <td>{{$v->post->post_name}}</td>
                                                                    <td>{{$v->candidate->candidate_name}}</td>
                                                                </tr>
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
