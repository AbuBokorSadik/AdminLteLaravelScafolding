@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    @include('alert.flashAlert')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Agent</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Agent</li>
                    </ol>
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
                            <h3 class="card-title">Add Agent</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => 'agents.store', 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('agentName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'agentName', 'placeholder' => 'Enter agent name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('agentEmail', 'Email') !!}
                                {!! Form::text('email','', ['id' => 'agentEmail', 'placeholder' => 'Enter agent email', 'class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('userTypeID', 'User Type') !!}
                                {!! Form::select('user_type_id', ['3' => 'Agent', ], '3', ['class' => 'form-control', 'id' => 'userTypeID', 'disabled', ]) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Add Agent', ['class' => 'btn btn-success btn-sm']) !!}
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