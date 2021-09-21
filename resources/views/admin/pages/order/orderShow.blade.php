@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
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
            @include('admin.pages.order.common.orderDetailsDom')

            @include('admin.pages.order.common.orderProductsDom')

            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Buyer Details</h3>
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
                                                        $imgpath = $order->orderAssignment->assignedBy->avater ? '/storage/' . $order->orderAssignment->assignedBy->avater : 'img/dummy-user.png';
                                                        @endphp
                                                        <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                                        {{ $order->orderAssignment->assignedBy->name }}
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
                                                        {{ $order->orderAssignment->assignedBy->email }}
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
                                                        {{ $order->orderAssignment->assignedBy->mobile }}
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
                                                        {{ $order->orderAssignment->assignedBy->address }}
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

            @include('admin.pages.order.common.productDetailsDom')

            @include('admin.pages.order.common.contactDetailsDom')

            @include('admin.pages.order.common.orderAssignmentActivityDom')

            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Total Receivable</h3>
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
                                                    <p><b>Amount</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ ceil($order->amount) }} <b> {{ config('app_configuration.currency')}} </b>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Service Charge</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ ceil($order->orderAssignment->service_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Area Charge</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ ceil($order->orderAssignment->area_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Weight Charge</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ ceil($order->orderAssignment->weight_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Delivery Type Charge</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ ceil($order->orderAssignment->delivery_type_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                        $total_payable = ceil($order->amount + $order->orderAssignment->service_charge + $order->orderAssignment->area_charge + $order->orderAssignment->weight_charge + $order->orderAssignment->delivery_type_charge);
                                        @endphp
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6 text-right">
                                                    <p><b>Total Receivable :</b> </p>
                                                </div>
                                                <div class="col-2 text-right">
                                                    <p>
                                                        {{ $total_payable }} <b> {{ config('app_configuration.currency')}} </b>
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
        </div>
        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('order.index') }}">
                </i>
                Cancel
            </a>
        </div>
    </section>
</div><!-- /.container-fluid -->

@endsection