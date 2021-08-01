@extends('guest')

@section('contentWrapper')

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Please check your email {{$user->email}} to the OTP</p>

      @include('alert.flashAlert')


      {!! Form::open(['route' => 'forgot-password-otp-verify', 'method' => 'get']) !!}
      {!! Form::hidden('email', $user->email) !!}
      <div class="input-group mb-3">
        {!! Form::text('otp',null,['class' => 'form-control', 'placeholder' => 'Enter 6 Digit OTP']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-key"></span>
          </div>
        </div>
        <div class="col-12">
          @error('otp')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          {!! Form::submit('Submit OTP', ['class' => 'btn btn-primary btn-block']) !!}
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