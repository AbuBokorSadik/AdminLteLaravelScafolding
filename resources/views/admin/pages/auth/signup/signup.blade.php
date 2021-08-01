@extends('guest')

@section('contentWrapper')

<div class="register-box">
  <div class="register-logo">
    <a href="#"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
      <div class="input-group mb-3">
        {!! Form::text('name',null,['class' => 'form-control', 'placeholder' => 'Full name']) !!}
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="col-12">
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>

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

      <div class="input-group mb-3">
        {!! Form::password('password_confirmation',['class' => 'form-control', 'placeholder' => 'Retype password']) !!}
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
        <div class="col">
          {!! Form::submit('Sign Up', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
        <!-- /.col -->
      </div>
      {!! Form::close() !!}

      <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>

@endsection