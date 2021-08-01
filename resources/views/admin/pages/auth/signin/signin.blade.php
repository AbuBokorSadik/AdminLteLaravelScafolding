@extends('guest')

@section('contentWrapper')

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @include('alert.flashAlert')

      {!! Form::open(['route' => 'signin', 'method' => 'post']) !!}
      <div class="input-group mb-3">
        {!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'Email']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="col-12">
          @error('email')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

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
      <div class="row">

        <!-- /.col -->
        <div class="col">
          {!! Form::submit('Sign In', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
        <!-- /.col -->
      </div>
      {!! Form::close() !!}


      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{ route('forgot-password') }}">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('signup') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection