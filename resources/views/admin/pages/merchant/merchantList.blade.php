@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Merchant List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Merchant List</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    @include('alert.flashAlert')
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'merchants.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantId', 'Id') !!}
                            {!! Form::text('id', old('id'), ['id' => 'merchantId', 'placeholder' => 'Enter merchant id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'merchantName', 'placeholder' => 'Enter merchant name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantEmail', 'Email') !!}
                            {!! Form::text('email', old('email'), ['id' => 'merchantEmail', 'placeholder' => 'Enter merchant email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantMobile', 'Mobile') !!}
                            {!! Form::text('mobile', old('mobile'), ['id' => 'merchantMobile', 'placeholder' => 'Enter merchant mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('merchantStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select merchant status...', '1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'merchantStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('createdAtDateRange', 'Select Created At Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('createdAtDateRange', old('createdAtDateRange'), ['id' => 'createdAtDateRange', 'class' => 'form-control float-right']) !!}
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


        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Merchant List</h3>
                <div class="card-tools">
                    {!! Form::open(['route' => 'merchants.create', 'method' => 'get']) !!}
                    {!! Form::button('<i class="fas fa-plus"> Add Merchant</i>', ['type'=>'submit', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                Id
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
                            <th class="text-center">
                                Avater
                            </th>
                            <th class="text-center">
                                Status
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Updated Time
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $merchant)
                        <tr>
                            <td>
                                {{ $merchant->id }}
                            </td>
                            <td>
                                {{ $merchant->name }}
                            </td>
                            <td>
                                {{ $merchant->email }}
                            </td>
                            <td>
                                {{ $merchant->mobile }}
                            </td>
                            <td class="text-center">
                                @php
                                $imgpath = $merchant->avater ? '/storage/' . $merchant->avater : 'img/dummy-user.png';
                                @endphp
                                <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                            </td>
                            <td class="project-state">
                                <span class="badge badge-{{ ($merchant->status) ? 'success' : 'danger' }}" style="width: 60px;">
                                    {{ ($merchant->status) ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                {{ $merchant->created_at }}
                            </td>
                            <td>
                                {{ $merchant->updated_at }}
                            </td>
                            @php
                            $btnClass = $merchant->status ? 'btn-danger' : 'btn-success'
                            @endphp
                            <td class="text-center" style="width: 200px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => ['merchants.update', $merchant->id], 'method' => 'put']) !!}
                                        {!! Form::button(($merchant->status) ? 'Inactive' : 'Active', ['type'=>'submit', 'class' => 'btn ' . $btnClass . ' btn-sm', 'style' => 'width:80px']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-sm-6">
                                        <a class="btn btn-info btn-sm" href="{{ route('merchants.show', $merchant->id) }}" style="width: 80px;">
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
                {{ $merchants->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection