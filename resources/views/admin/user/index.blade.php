@extends('admin.layouts.app')
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Users
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"> Home</a></li>
                <li class="active">User</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @include('admin.message.flash')
            <div class="row">
                <div class="col-md-9" id="listing">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Users</h3>
                        </div>
                        <div class="box-body">
                            @if(!count($users)<=0)
                                <div class="table-responsive">
                                    <table id="example1"
                                           class="table table-striped table-bordered table-hover table-responsive">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">S.N</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th style="width: 70px;" class="text-right">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        $i = 1;
                                        ?>
                                        @foreach($users as $user)
                                            <tr>
                                                <th scope=row>{{$i++}}</th>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('user.edit',[$user->id])}}"
                                                       class="text-info btn btn-xs btn-default"
                                                       data-toggle="tooltip"
                                                       data-placement="top" title="Edit">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>&nbsp;

                                                    {!! Form::open(['method' => 'DELETE', 'class'=>'inline', 'route'=>['user.destroy',
                                                        $user->id]]) !!}
                                                    <button type="submit"
                                                            class="btn btn-danger btn-xs deleteButton actionIcon"
                                                            data-toggle="tooltip"
                                                            data-placement="top" title="Delete"
                                                            onclick="javascript:return confirm('Are you sure you want to delete?');">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                    {!! Form::close() !!}
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

                <div class="col-md-3">
                    @if(\Request::segment(4)=='edit')
                        @include('admin.user.edit')
                    @else
                        @include('admin.user.add')
                    @endif

                </div>
            </div>
        </section>
    </div>
@endsection