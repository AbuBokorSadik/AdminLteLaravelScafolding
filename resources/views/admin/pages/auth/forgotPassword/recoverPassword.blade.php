@extends('guest')

@section('contentWrapper')
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
      
      @include('alert.flashAlert')

      {!! Form::open(['route' => 'reset-password', 'method' => 'post']) !!}
      {!! Form::hidden('email', $user->email) !!}
      {!! Form::hidden('otp', $otp->otp) !!}
      <div class="input-group mb-3">
        {!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="col-12">
          @error('password')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="input-group mb-3">
        {!! Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="col-12">
          @error('password_confirmation')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          {!! Form::submit('Change password', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
        <!-- /.col -->
      </div>
      {!! Form::close() !!}

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection