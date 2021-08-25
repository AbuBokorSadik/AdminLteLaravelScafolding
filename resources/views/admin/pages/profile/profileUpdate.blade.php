@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Update</h1>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    @include('alert.flashAlert')
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Profile Update</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['profiles.update', auth()->user()->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Name</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('name', auth()->user()->name, ['placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('address', auth()->user()->address, ['placeholder' => 'Enter address...', 'class' => 'form-control']) !!}
                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('email', auth()->user()->email, ['placeholder' => 'Enter email...', 'class' => 'form-control', 'disabled' ]) !!}
                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('mobile', auth()->user()->mobile, ['placeholder' => 'Enter mobile...', 'class' => 'form-control', 'disabled', ]) !!}
                                                    @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Additional email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('additional_email', auth()->user()->additional_email, ['placeholder' => 'Enter additional email...', 'class' => 'form-control']) !!}
                                                    @error('additional_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Additional mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('additional_mobile', auth()->user()->additional_mobile, ['placeholder' => 'Enter additional mobile number...', 'class' => 'form-control']) !!}
                                                    @error('additional_mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <p>{{ auth()->user()->addditional_mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Type</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    {!! Form::text('user_type_id', auth()->user()->userType->name, ['placeholder' => 'Enter user type...', 'class' => 'form-control', 'disabled']) !!}
                                                    @error('user_type_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                        $status = auth()->user()->status ? " class='fas fa-check-circle fa-2x' style='color:green'" : " class='fas fa-times-circle fa-2x' style='color:red'";
                                        @endphp
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Status</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <i {{!! $status !!}}></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Avater</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <div class="custom-file">
                                                        {!! Form::label('chooseFile', 'Select avater file', ['class' => 'custom-file-label']) !!}
                                                        {!! Form::file('avater', ['id' => 'chooseFile', 'class' => 'custom-file-input']) !!}
                                                        @error('avater')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @php
                                $imgpath = auth()->user()->avater ? '/storage/' . auth()->user()->avater : 'img/dummy-user.png';
                                @endphp
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <img class="img-thumbnail" style="height: 250px; width: 250px;" src="{{ asset($imgpath) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Update Profile', ['class' => 'btn btn-success']) !!}
                            <a class="btn btn-secondary" href="{{ route('profiles.index') }}">
                                </i>
                                Cancel
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection