@extends('app')

@section('customJs')
<script>
    $(function() {
        const updateStatus = function() {
            if ($(this).val() == "{{ App\Constant\OrderStatusTypeConst::RESCHEDULE }}") {
                $("#deadline").val($(this).attr("taskDeadline"));
                $("#rescheduleStatusModal").modal('show');
            } else if ($(this).val() == "{{ App\Constant\OrderStatusTypeConst::SUCCESSFUL }}") {
                $("#successfulStatusModal").modal('show');
            } else {
                $("#taskStatusChangeModal").modal('show');
            }

            const orderAssignmentId = $(this).attr("orderAssignmentId");
            const orderStatusId = $(this).val();
            $("#formOrderAssignmentId").val(orderAssignmentId);
            $("#formOrderStatusId").val(orderStatusId);
            // alert("Aid: " + orderAssignmentId + "Oid: " + orderStatusId);
        }

        $(".change_order_status_id").change(updateStatus);
    });
</script>
@endsection

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Task List</li>
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
            {!! Form::open(['route' => 'tasks.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('taskId', 'Task Id') !!}
                            {!! Form::text('task_id', old('task_id'), ['id' => 'taskId', 'placeholder' => 'Enter task id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('orderId', 'Order Id') !!}
                            {!! Form::text('order_id', old('assigned_by'), ['id' => 'orderId', 'placeholder' => 'Enter order id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactName', 'Contact Name') !!}
                            {!! Form::text('contact_name', old('contact_name'), ['id' => 'contactName', 'placeholder' => 'Enter contact name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactEmail', 'Contact Email') !!}
                            {!! Form::text('contact_email', old('contact_email'), ['id' => 'contactEmail', 'placeholder' => 'Enter contact email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactMobile', 'Contact Mobile') !!}
                            {!! Form::text('contact_mobile', old('contact_mobile'), ['id' => 'contactMobile', 'placeholder' => 'Enter contact mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('orderType', 'Task Type') !!}
                            {!! Form::select('order_type_id', [null => 'Select order type...', '1' => 'Pickup', '2' => 'Delivery'], old('order_type_id'), ['class' => 'form-control', 'id' => 'orderStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('deadlineDateRange', 'Select Deadline Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('deadlineDateRange', old('deadlineDateRange'), ['class' => 'form-control float-right reservationtime']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('createdAtDateRange', 'Select Created At Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('createdAtDateRange', old('createdAtDateRange'), ['class' => 'form-control float-right reservationtime']) !!}
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
                <h3 class="card-title">Task List</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped projects text-center">
                    <thead>
                        <tr>
                            <th>
                                Task Id
                            </th>
                            <th>
                                Order Id
                            </th>
                            <th>
                                Assignee
                            </th>
                            <th>
                                Contact Name
                            </th>
                            <th>
                                Contact Email
                            </th>
                            <th>
                                Contact Mobile
                            </th>
                            <th>
                                Contact Address
                            </th>
                            <th>
                                Task Type
                            </th>
                            <th>
                                Task Status
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Collected Amount
                            </th>
                            <th>
                                Service Charge
                            </th>
                            <th>
                                Deadline
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>
                                <span style="font-weight: bold; color: #3d9970;">
                                    {{ $task->task_id}}
                                </span>
                            </td>
                            <td>
                                <span style="font-weight: bold; color: #3d9970;">
                                    {{ $task->orderAssignment->order->order_id}}
                                </span>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                        $imgpath = $task->assignedTo->avater ? '/storage/' . $task->assignedTo->avater : 'img/dummy-user.png';
                                        @endphp
                                        <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                    </div>
                                    <div class="col-sm-12">
                                        {{ $task->assignedTo->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        {{ $task->assignedTo->mobile }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $task->contact_name }}
                            </td>
                            <td>
                                {{ $task->contact_email }}
                            </td>
                            <td>
                                {{ $task->contact_mobile }}
                            </td>
                            <td>
                                {{ $task->contact_address }}
                            </td>
                            <td>
                                {!! Form::submit($task->orderAssignment->order->orderType->type, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $task->orderAssignment->order->orderType->color . '; width: 80px;']) !!}
                            </td>
                            <td>
                                @if($task->status->id == App\Constant\OrderStatusTypeConst::CANCELED || $task->status->id == App\Constant\OrderStatusTypeConst::SUCCESSFUL)
                                {!! Form::submit($task->status->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $task->status->color . '; width: 130px;']) !!}
                                @else
                                {!! Form::select('change_order_status_id', $orderStatuses, $task->status->id, ['class' => 'form-control change_order_status_id', 'id' => 'change_order_status_id', 'orderAssignmentId' => $task->order_assignment_id, 'taskDeadline' => date('m/d/y', strtotime($task->deadline)), 'style' => 'background-color:' . $task->status->color . ';width: 130px;']) !!}
                                @endif
                            </td>
                            <td>
                                {{ ceil($task->assigned_amount) }} <b> {{ config('app_configuration.currency')}} </b>
                            </td>
                            <td>
                                {{ ceil($task->collected_amount) }} <b> {{ config('app_configuration.currency')}} </b>
                            </td>
                            <td>
                                {{ ceil($task->service_charge) }} <b> {{ config('app_configuration.currency')}} </b>
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($task->deadline)) }}
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($task->created_at)) }}
                            </td>
                            <td class="text-center">
                                @if($task->status->id == App\Constant\OrderStatusTypeConst::CANCELED || $task->status->id == App\Constant\OrderStatusTypeConst::SUCCESSFUL)
                                @else
                                <a class="btn btn-info btn-sm" href="{{ route('tasks.edit', $task->id) }}" style="width: 80px;">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                @endif

                                <a class="btn btn-info btn-sm" href="{{ route('tasks.show', $task->id) }}" style="width: 80px;">
                                    <i class="fas fa-eye"></i>
                                    Show
                                </a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $tasks->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>

<!-- order status change modal -->

{!! Form::open(['route' => 'task.status.update', 'method' => 'post']) !!}

<div class="modal fade" id="taskStatusChangeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change Task Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="modal-body text-center">
                        <p>Are you sure to change the task status.</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::submit('Change task status', ['class' => 'btn btn-success']) !!}
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="rescheduleStatusModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Reschedule Task</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <p><b>Deadline</b> </p>
                        </div>
                        <div class="col">
                            {!! Form::text('deadline', '', ['class' => 'form-control float-right deadlineDate', 'id' => 'deadline']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::submit('Reschedule task', ['class' => 'btn btn-success']) !!}
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="successfulStatusModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Collected Amount</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <p><b>Amount</b></p>
                        </div>
                        <div class="col">
                            {!! Form::number('collected_amount', null, ['id' => 'collectedAmount', 'placeholder' => 'Enter amount...', 'class' => 'form-control', 'min' => 0]) !!}
                        </div>
                        <div class="col-2">
                            <b> {{ config('app_configuration.currency')}} </b>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::submit('Save change', ['class' => 'btn btn-success']) !!}
            </div>

        </div>
    </div>
</div>

{!! Form::hidden('formOrderAssignmentId', '', ['id' => 'formOrderAssignmentId']) !!}
{!! Form::hidden('formOrderStatusId', '', ['id' => 'formOrderStatusId']) !!}
{!! Form::close() !!}

@endsection