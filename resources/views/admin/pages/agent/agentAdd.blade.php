@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
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

    <!-- error message -->
    <section class="content">
        <div class="container-fluid row mb-2">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- add section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Agent</h3>
                        </div>
                        {!! Form::open(['route' => 'agents.store', 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('agentName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'agentName', 'placeholder' => 'Enter name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('agentEmail', 'Email') !!}
                                {!! Form::text('email','', ['id' => 'agentEmail', 'placeholder' => 'Enter email', 'class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('agentMobile', 'Mobile') !!}
                                {!! Form::text('mobile','', ['id' => 'agentMobile', 'placeholder' => 'Enter mobile', 'class' => 'form-control']) !!}
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('userTypeID', 'User Type') !!}
                                {!! Form::select('user_type_id', [ App\Constant\UserTypeConst::AGENT => 'Agent', ], App\Constant\UserTypeConst::AGENT, ['class' => 'form-control', 'id' => 'userTypeID', 'readonly', ]) !!}
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Add Agent', ['class' => 'btn btn-success']) !!}
                            
                            <a class="btn btn-secondary" href="{{ route('agents.index') }}">
                                </i>
                                Cancel
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection