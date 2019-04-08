@extends('admin.layouts.app')

@section('content')

    <div class="content-wrapper" style="min-height: 1080px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Recent Events
                <small>Result of Voting</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Dashboard</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-default color-palette-box">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-tag"></i> Voting</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @forelse($events as $event)
                                <?php
                                $votes = \App\Repository\OrganizerRepository::getVotesByEvent($event->id);
                                ?>

                                <h4> Event Title: {{$event->event_name}}</h4>
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th>Post</th>
                                        <th>Candidate</th>
                                        <th>Votes</th>
                                    </tr>
                                    </thead>
                                    @foreach($votes as $v)
                                        <?php
                                        $canVotes = \App\Repository\OrganizerRepository::getCanVote($v->can_id);
                                        ?>
                                        <tbody>
                                        <tr>
                                            <td>{{$v->post->post_name}}</td>
                                            <td>{{$v->candidate->candidate_name}}</td>
                                            <td>{{$canVotes}}</td>
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            @empty<h1>No Current Events</h1>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
