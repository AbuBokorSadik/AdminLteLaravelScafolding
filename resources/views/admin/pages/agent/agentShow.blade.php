@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agent Details</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Main section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Agent Details</h3>
                        </div>
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
                                                    <p>{{ $agent->name }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->address }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Additional email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->additional_email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Additional mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->additional_mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Type</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $agent->userType->name }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                        $status = $agent->status ? " class='fas fa-check-circle fa-2x' style='color:green'" : " class='fas fa-times-circle fa-2x' style='color:red'";
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
                                $imgpath = $agent->avatar ? '/storage/' . $agent->avatar : 'img/dummy-user.png';
                                @endphp
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <img class="img-thumbnail" style="height: 250px; width: 250px;" src="{{ asset($imgpath) }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-secondary" href="{{ route('agents.index') }}">
                                </i>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection