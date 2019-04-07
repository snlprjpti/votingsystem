<div class="row">
    <div class="col-md-12">

@if (Session::has('success'))
    <div class="alert alert-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning">
        <i class="fa fa-warning" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('warning') }}
    </div>
@endif

@if (Session::has('status'))
    <div class="alert alert-success">
        <i class="fa fa-check" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('status') }}
    </div>
@endif



@if (Session::has('notFoundError'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('notFoundError') }}
    </div>
@endif


@if (Session::has('foreignerror'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('foreignerror') }}
    </div>
@endif


@if (Session::has('error_new_password'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error_new_password') }}
    </div>
@endif


@if (Session::has('psw_not_matched'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('psw_not_matched') }}
    </div>
@endif


@if (Session::has('old_password_not_matched'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('old_password_not_matched') }}
    </div>
@endif


@if (Session::has('password_required'))
    <div class="alert alert-danger">
        <i class="fa fa-times" aria-hidden="true"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('password_required') }}
    </div>
@endif
    @if (Session::has('info'))
        <div class="alert alert-info">
            <i class="fa fa-times" aria-hidden="true"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('info') }}
        </div>
    @endif
    </div></div>