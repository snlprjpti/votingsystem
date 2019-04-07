<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Edit </h3>

    </div>
    <div class="box-body">
        {!! Form::model($edits,['method'=>'PUT','route'=>['organizer.update',$edits->id]]) !!}
        <div class="form-group {{ ($errors->has('name'))?'has-error':'' }}">
            <label>Organizer Name:</label>
            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'User Name']) !!}
            {!! $errors->first('name', '<span class="label-danger">:message</span>') !!}
        </div>
        <!-- /.form group -->
        <div class="form-group {{ ($errors->has('email'))?'has-error':'' }}">
            <label>Email:</label>
            {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'email@example.com']) !!}
            {!! $errors->first('email', '<span class="label-danger">:message</span>') !!}
        </div>

        <!-- /.form group -->
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Update</button>
                {{--<button type="submit" class="btn btn-default bg-green">Save & Add New</button>--}}

            </div>
            <!-- /.box-footer -->

        </div>
        {!! Form::close() !!}


    </div>
    <!-- /.box-body -->
</div>