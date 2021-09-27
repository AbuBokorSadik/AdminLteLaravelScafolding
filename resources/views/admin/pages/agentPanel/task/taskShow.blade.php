@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task Details</h1>
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
            @include('admin.pages.task.common.taskDetailsDom')

            @include('admin.pages.task.common.orderProductsDom')

            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Assigned By</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Name</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        @php
                                                        $imgpath = $task->assignedBy->avater ? '/storage/' . $task->assignedBy->avater : 'img/dummy-user.png';
                                                        @endphp
                                                        <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                                        {{ $task->assignedBy->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $task->assignedBy->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $task->assignedBy->mobile }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $task->assignedBy->address }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.pages.task.common.productDetailsDom')
            @include('admin.pages.task.common.contactDetailsDom')
            @include('admin.pages.task.common.taskStatusActivityDom')
            @include('admin.pages.task.common.paymentDetailsDom')

        </div>
        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('agent-tasks.index') }}">
                </i>
                Cancel
            </a>
        </div>
    </section>
</div><!-- /.container-fluid -->

@endsection