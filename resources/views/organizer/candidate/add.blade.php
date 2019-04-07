<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add Event</h3>

    </div>
    <div class="box-body">

        {!! Form::open(['method'=>'post','url'=>'organizer/candidates']) !!}


        <div class="form-group {{ ($errors->has('post_id'))?'has-error':'' }}">
            <label>Post</label>
            {{Form::select('post_id',$posts->pluck('post_name','id'),Request::get('post_id'),['class'=>'form-control select2','placeholder'=>
            'Select Post'])}}
            {!! $errors->first('post_id', '<span class="label-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('candidate_name'))?'has-error':'' }}">
            <label>Candidate Name:</label>
            {!! Form::text('candidate_name',null,['class'=>'form-control','placeholder'=>'Candidate Name']) !!}
            {!! $errors->first('candidate_name', '<span class="label-danger">:message</span>') !!}
        </div>

        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>