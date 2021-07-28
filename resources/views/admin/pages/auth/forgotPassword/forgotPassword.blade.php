@extends('guest')

@section('contentWrapper')

<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      {!! Form::open(['route' => 'recover-password', 'method' => 'get']) !!}
      <div class="input-group mb-3">
        {!! Form::text('email',null,['class' => 'form-control', 'placeholder' => 'Email']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>
      @error('email')
      <span class="text-danger">{{ $message }}</span>
      @enderror
      <div class="row">
        <div class="col-12">
          {!! Form::submit('Request new password', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
        <!-- /.col -->
      </div>
      {!! Form::close() !!}

      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">Login</a>
      </p>
      <p class="mb-0">
        <a href="{{ route('signup') }}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>

@endsection