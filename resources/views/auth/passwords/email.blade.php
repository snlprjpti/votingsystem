@extends('layouts.app')

@section('content')

    @include('backend.message.flash')

    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-3 control-label">E-Mail Address</label>

            <div class="col-md-9">
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ old('email') }}" required autofocus placeholder="example@email.com">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </div>
    </form>

@endsection
