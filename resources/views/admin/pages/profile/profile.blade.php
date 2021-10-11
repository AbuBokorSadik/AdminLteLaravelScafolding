@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a class="btn btn-info" href="{{ route('profiles.edit',auth()->user()->id) }}">
                                Profile Update
                            </a>
                        </li>
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
                <div class="col">
                    <div class="card card-success card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Basic Details</a>
                                </li>
                                @if(auth()->user()->user_type_id != App\Constant\UserTypeConst::AGENT)
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Account Details</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Name</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->name }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Address</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->address }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Email</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->email }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Mobile</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->mobile }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Additional email</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->additional_email }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Additional mobile</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->additional_mobile }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Type</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->userType->name }}</p>
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
                                            </ul>
                                        </div>
                                        @php
                                        $imgpath = auth()->user()->avatar ? '/storage/' . auth()->user()->avatar : 'img/dummy-user.png';
                                        @endphp
                                        <div class="col-sm-4">
                                            <div class="text-center">
                                                <img class="img-thumbnail" style="height: 250px; width: 250px;" src="{{ asset($imgpath) }}" alt="Avatar not found.">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(auth()->user()->user_type_id != App\Constant\UserTypeConst::AGENT)
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <ul class="list-group list-group-unbordered mb-3">
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Account No.</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->account->account_no }}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><b>Balance</b> </p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p>{{ auth()->user()->account->balance }} <b> {{ config('app_configuration.currency')}} </b> </p>
                                                        </div>
                                                    </div>
                                                </li>
                                                @php
                                                $status = auth()->user()->account->status ? " class='fas fa-check-circle fa-2x' style='color:green'" : " class='fas fa-times-circle fa-2x' style='color:red'";
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
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>

</div>

@endsection