@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
            </div>
            @include('alert.flashAlert')
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        {!! Form::open(['route' => 'change-password-update', 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="oldPassword">Old Password</label>
                                {!! Form::password('old_password',['class' => 'form-control', 'id' => 'oldPassword', 'placeholder' => 'Old Password']) !!}
                                @error('old_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                {!! Form::password('password',['class' => 'form-control', 'id' => 'oldPassword', 'placeholder' => 'New Password']) !!}
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="re-typePassword">Re-type Password</label>
                                {!! Form::password('password_confirmation',['class' => 'form-control', 'id' => 'oldPassword', 'placeholder' => 'Re-type Password']) !!}
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="card-footer">
                                {!! Form::submit('Change Password', ['class' => 'btn btn-success']) !!}
                                {!! Form::submit('Cancel', ['class' => 'btn btn-default float-right']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
    </section>
</div>

@endsection