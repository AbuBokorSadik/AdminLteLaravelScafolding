@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Merchant</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Merchant</li>
                    </ol>
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
                            <h3 class="card-title">Add Merchant</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => 'merchants.store', 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('merchantName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'merchantName', 'placeholder' => 'Enter merchant name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('merchantEmail', 'Email') !!}
                                {!! Form::text('email','', ['id' => 'merchantEmail', 'placeholder' => 'Enter merchant email', 'class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('merchantMobile', 'Mobile') !!}
                                {!! Form::text('mobile','', ['id' => 'merchantMobile', 'placeholder' => 'Enter merchant mobile', 'class' => 'form-control']) !!}
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('userTypeID', 'User Type') !!}
                                {!! Form::select('user_type_id', ['2' => 'Merchant', ], '2', ['class' => 'form-control', 'id' => 'userTypeID', 'disabled', ]) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Add Merchant', ['class' => 'btn btn-success btn-sm']) !!}
                            <a class="btn btn-secondary btn-sm" href="{{ route('merchants.index') }}">
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