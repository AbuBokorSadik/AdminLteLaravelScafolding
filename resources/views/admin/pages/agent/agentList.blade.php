@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agent List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Agent List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'agents.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('agentName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'agentName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('agentEmail', 'Email') !!}
                            {!! Form::text('email', old('email'), ['id' => 'agentEmail', 'placeholder' => 'Enter email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('agentMobile', 'Mobile') !!}
                            {!! Form::text('mobile', old('mobile'), ['id' => 'agentEmail', 'placeholder' => 'Enter mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('agentStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select agent status...', App\Constant\StatusTypeConst::ACTIVE => 'Active', App\Constant\StatusTypeConst::INACTIVE => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'agentStatus', ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('createdAtDateRange', 'Select Created At Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('createdAtDateRange', old('createdAtDateRange'), ['class' => 'form-control float-right dateRange']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Search', ['class' => 'btn btn-success']) !!}
                {!! Form::submit('Clear Filter', ['class' => 'btn btn-secondary', 'id' => 'clear']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </section>

    <!-- error message -->
    <section class="content">
        <div class="row mb-2">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- agent list section -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agent List</h3>
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('agents.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add Agent
                    </a>

                    @php
                    $agent_ids = $agents->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('agent.user.export', $agent_ids) }}" style="width: 150px;">
                        <i class="fas fa-file-download"></i>
                        Export Excel
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th>
                                Sl#
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Mobile
                            </th>
                            <th>
                                Avatar
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Updated Time
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($agents->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @php
                        $serial = 1;
                        @endphp

                        @foreach($agents as $agent)
                        <tr>
                            <td>
                                {{ $serial }}
                            </td>
                            <td>
                                {{ $agent->name }}
                            </td>
                            <td>
                                {{ $agent->email }}
                            </td>
                            <td>
                                {{ $agent->mobile }}
                            </td>
                            <td>
                                @php
                                $serial++;
                                $imgpath = $agent->avatar ? '/storage/' . $agent->avatar : 'img/dummy-user.png';
                                @endphp
                                <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                            </td>
                            <td class="project-state">
                                <span class="badge badge-{{ ($agent->status) ? 'success' : 'danger' }}" style="width: 60px;">
                                    {{ ($agent->status) ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                {{ $agent->created_at }}
                            </td>
                            <td>
                                {{ $agent->updated_at }}
                            </td>
                            <td style="width: 200px;">

                                @php
                                $btnClass = $agent->status ? 'btn-danger' : 'btn-success'
                                @endphp
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => ['agents.update', $agent->id], 'method' => 'put']) !!}
                                        {!! Form::button(($agent->status) ? 'Inactive' : 'Active', ['type'=>'submit', 'class' => 'btn ' . $btnClass . ' btn-sm', 'style' => 'width:80px']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="btn btn-info btn-sm" href="{{ route('agents.show', $agent->id) }}" style="width: 80px;">
                                            <i class="fas fa-eye"></i>
                                            Show
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $agents->links() }}
            </div>
        </div>
    </section>
</div>

@endsection