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
                                        <p><b>Payment Status</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>
                                            {{ $order->orderAssaingment->payment }}
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