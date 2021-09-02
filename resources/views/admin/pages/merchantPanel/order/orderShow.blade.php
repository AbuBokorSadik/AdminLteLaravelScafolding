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
            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Order Details</h3>
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
                                                    <p><b>Order Id</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        <span style="font-weight: bold; color: #3d9970;">
                                                            {{ $order->order_id }}
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Order Type</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {!! Form::submit($order->orderType->type, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $order->orderType->color . '; width: 80px;']) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Deadline</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ date('d M, Y', strtotime($order->deadline)) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Reference Id</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->ref_id }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Amount</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ ceil($order->amount) }} <b> {{ config('app_configuration.currency')}} </b>
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
            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Assignment Details</h3>
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
                                                    <p><b>Seller Name</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->assaignedTo->name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Order Status</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                    {!! Form::submit($order->orderAssaingment->orderStatus->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $order->orderAssaingment->orderStatus->color . '; width: 80px;']) !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Service Charge</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->service_charge }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Area Charge</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->area_charge }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Weight Charge</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->weight_charge }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Delivery Type Charge</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->delivery_type_charge }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Payment Status</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>
                                                        {{ $order->orderAssaingment->payment }}
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
            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
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
                                                    <p><b>Product Weight</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->product_weight }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Product Height</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->product_height }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Product Length</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->product_length }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Product Width</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->product_width }}</p>
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
            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Contact Details</h3>
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
                                                    <p><b>Contact Name</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_name }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Address</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Email</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_email }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Contact Mobile</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->contact_mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address Latitude</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address_lat }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Address Longitude</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->address_lng }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Instruction</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->instruction }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">
                                                    <p><b>Note</b> </p>
                                                </div>
                                                <div class="col-6">
                                                    <p>{{ $order->note }}</p>
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
        </div><!-- /.container-fluid -->
        <div class="card-footer">
            <a class="btn btn-secondary" href="{{ route('orders.index') }}">
                </i>
                Cancel
            </a>
        </div>
    </section>
    <!-- /.content -->
</div>

@endsection