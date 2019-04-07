<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add Post</h3>

    </div>
    <div class="box-body">

        {!! Form::open(['method'=>'post','url'=>'organizer/posts']) !!}

        <div class="form-group {{ ($errors->has('post_name'))?'has-error':'' }}">
            <label>Post Name:</label>
            {!! Form::text('post_name',null,['class'=>'form-control','placeholder'=>'Manager']) !!}
            {!! $errors->first('post_name', '<span class="label-danger">:message</span>') !!}
        </div>

        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>