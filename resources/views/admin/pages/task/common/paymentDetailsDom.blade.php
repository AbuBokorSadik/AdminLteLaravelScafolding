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
                                            {{ ceil($task->assigned_amount) }} <b> {{ config('app_configuration.currency')}} </b>
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
                                            {{ ceil($task->orderAssignment->service_charge) }} <b> {{ config('app_configuration.currency')}} </b>
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
                                            {{ ceil($task->orderAssignment->area_charge) }} <b> {{ config('app_configuration.currency')}} </b>
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
                                            {{ ceil($task->orderAssignment->weight_charge) }} <b> {{ config('app_configuration.currency')}} </b>
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
                                            {{ ceil($task->orderAssignment->delivery_type_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            @php
                            $total_payable = ceil($task->amount + $task->orderAssignment->service_charge + $task->orderAssignment->area_charge + $task->orderAssignment->weight_charge + $task->orderAssignment->delivery_type_charge);
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