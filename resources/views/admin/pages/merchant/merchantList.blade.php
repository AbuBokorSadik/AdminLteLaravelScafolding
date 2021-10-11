@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'merchants.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'merchantName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantEmail', 'Email') !!}
                            {!! Form::text('email', old('email'), ['id' => 'merchantEmail', 'placeholder' => 'Enter email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantMobile', 'Mobile') !!}
                            {!! Form::text('mobile', old('mobile'), ['id' => 'merchantMobile', 'placeholder' => 'Enter mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('merchantStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select status...', App\Constant\StatusTypeConst::ACTIVE => 'Active', App\Constant\StatusTypeConst::INACTIVE => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'merchantStatus', ]) !!}
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-sm-3">
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

    <!-- order list section -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Merchant List</h3>
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('merchants.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add Merchant
                    </a>
                    @php
                    $merchant_ids = $merchants->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('merchant.user.export', $merchant_ids) }}" style="width: 150px;">
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
                                avatar
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
                        @if ($merchants->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @php
                        $serial = 1;
                        @endphp

                        @foreach($merchants as $merchant)
                        <tr>
                            <td>
                                {{ $serial }}
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
                                $serial++;
                                $imgpath = $merchant->avatar ? '/storage/' . $merchant->avatar : 'img/dummy-user.png';
                                @endphp
                                <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="Image not found.">
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
                                        {!! Form::button(($merchant->status) ? 'Inactive' : 'Active', ['type'=>'submit', 'class' => 'btn ' . $btnClass . ' btn-sm', 'style' => 'width: 80px;']) !!}
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
        </div>
    </section>
</div>

@endsection