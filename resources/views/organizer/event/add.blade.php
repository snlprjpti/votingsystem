<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Add Event</h3>

    </div>
    <div class="box-body">

        {!! Form::open(['method'=>'post','url'=>'organizer/events']) !!}

        <div class="form-group {{ ($errors->has('event_name'))?'has-error':'' }}">
            <label>Event Name:</label>
            {!! Form::text('event_name',null,['class'=>'form-control','placeholder'=>'Event Name']) !!}
            {!! $errors->first('event_name', '<span class="label-danger">:message</span>') !!}
        </div>

        <div class="form-group {{ ($errors->has('details'))?'has-error':'' }}">
            <label>Details:</label>
                {!! Form::textarea('details',null,['class'=>'form-control','placeholder'=>'explain']) !!}
            {!! $errors->first('details', '<span class="label-danger">:message</span>') !!}
        </div>
        <div class="form-group {{ ($errors->has('event_date'))?'has-error':'' }}">
            <label>Date:</label>
                {!! Form::text('event_date',null,['class'=>'form-control','id'=> 'datepicker']) !!}
            {!! $errors->first('event_date', '<span class="label-danger">:message</span>') !!}
        </div>
        <div class="box-footer">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        {!! Form::close() !!}

    </div>
</div>