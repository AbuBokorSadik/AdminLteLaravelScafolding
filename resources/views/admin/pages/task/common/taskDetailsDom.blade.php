<div class="row">
    <div class="col-md">
        <!-- general form elements -->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Task Details</h3>
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
                                        <p><b>Task Id</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>
                                            <span style="font-weight: bold; color: #3d9970;">
                                                {{ $task->task_id }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Order Id</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>
                                            <span style="font-weight: bold; color: #3d9970;">
                                                {{ $task->orderAssignment->order->order_id }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Task Type</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>
                                            {!! Form::submit($task->orderAssignment->order->orderType->type, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $task->orderAssignment->order->orderType->color . '; width: 80px;']) !!}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-6">
                                        <p><b>Task Status</b> </p>
                                    </div>
                                    <div class="col-6">
                                        <p>
                                            {!! Form::submit($task->status->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $task->status->color . '; width: 80px;']) !!}
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
                                            {{ $task->payment }}
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
                                            {{ date('d M, Y', strtotime($task->deadline)) }}
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
                                        <p>{{ $task->ref_id }}</p>
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
                                            {{ ceil($task->assigned_amount) }} <b> {{ config('app_configuration.currency')}} </b>
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