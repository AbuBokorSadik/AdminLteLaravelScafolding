@extends('app')

@section('customJs')
<script>
    $(function() {
        const updateStatus = function() {
            if ($(this).val() == "{{ App\Constant\OrderStatusTypeConst::RESCHEDULE }}") {
                $("#deadline").val($(this).attr("orderDeadline"));
                $("#rescheduleStatusModal").modal('show');

            } else if ($(this).val() == "{{ App\Constant\OrderStatusTypeConst::SUCCESSFUL }}") {
                $("#successfulStatusModal").modal('show');
            } else {
                $("#orderStatusChangeModal").modal('show');
            }

            const orderAssignmentId = $(this).attr("orderAssignmentId");
            const orderStatusId = $(this).val();
            $("#formOrderAssignmentId").val(orderAssignmentId);
            $("#formOrderStatusId").val(orderStatusId);
            // alert("Aid: " + orderAssignmentId + "Oid: " + orderStatusId);
        }

        const assignAgent = function() {
            $("#orderAssignmentId").val($(this).attr("orderAssignmentId"));
            $("#agentId").val($(this).val());

            const getUrl = "{{ URL('admin/agent-info') }}" + "/" + $(this).val();

            $.ajax({
                type: "GET",
                url: getUrl,
                success: function(response) {
                    const data = JSON.parse(response);
                    if (data.code == 200) {
                        $("#message").html(data.data);
                        // console.log(data.data);
                    } else {
                        alert("Something went wrong. Please try again later.");
                    }
                },
                error: function() {
                    alert("Something went wrong. Please try again later.");
                }
            });

            $("#agentSelectModal").modal('show');

            // alert();
        }

        $(".agents").change(assignAgent);

        $(".change_order_status_id").change(updateStatus);
    });
</script>
@endsection

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Order List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'order.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('orderId', 'Order Id') !!}
                            {!! Form::text('order_id', old('order_id'), ['id' => 'orderId', 'placeholder' => 'Enter order id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactName', 'Contact Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'contactName', 'placeholder' => 'Enter contact name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactEmail', 'Contact Email') !!}
                            {!! Form::text('email', old('email'), ['id' => 'contactEmail', 'placeholder' => 'Enter contact email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactMobile', 'Contact Mobile') !!}
                            {!! Form::text('mobile', old('mobile'), ['id' => 'contactMobile', 'placeholder' => 'Enter contact mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('orderType', 'Order Type') !!}
                            {!! Form::select('order_type_id', [null => 'Select order type...', '1' => 'Pickup', '2' => 'Delivery'], old('order_type_id'), ['class' => 'form-control', 'id' => 'orderStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('deadlineDateRange', 'Select Deadline Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('deadlineDateRange', old('deadlineDateRange'), ['class' => 'form-control float-right dateRange']) !!}
                            </div>
                        </div>
                    </div>
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
                <h3 class="card-title">Order List</h3>
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('order.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add order
                    </a>

                    @php
                    $order_ids = $orders->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('order.export', $order_ids) }}" style="width: 150px;">
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
                                Order Id
                            </th>
                            <th>
                                Assignee
                            </th>
                            <th>
                                Buyer Information
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
                                Order Type
                            </th>
                            <th>
                                Order Status
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Collected Amount
                            </th>
                            <th>
                                Deadline
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Assign Order
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @foreach($orders as $order)
                        <tr>
                            <td>
                                <span style="font-weight: bold; color: #3d9970;">
                                    {{ $order->order_id}}
                                </span>
                            </td>
                            <td>
                                @if(!empty($order->orderAssignment->task))
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                        $imgpath = $order->orderAssignment->task->assignedTo->avatar ? '/storage/' . $order->orderAssignment->task->assignedTo->avatar : 'img/dummy-user.png';
                                        @endphp
                                        <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                    </div>
                                    <div class="col-sm-12">
                                        {{ $order->orderAssignment->task->assignedTo->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        {{ $order->orderAssignment->task->assignedTo->mobile }}
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        @php
                                        $imgpath = $order->orderAssignment->assignedBy->avatar ? '/storage/' . $order->orderAssignment->assignedBy->avatar : 'img/dummy-user.png';
                                        @endphp
                                        <img class="profile-user-img img-fluid img-circle" style="height: 45px; width: 45px;" src="{{ asset($imgpath) }}" alt="">
                                    </div>
                                    <div class="col-sm-12">
                                        {{ $order->orderAssignment->assignedBy->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        {{ $order->orderAssignment->assignedBy->mobile }}
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ $order->contact_name }}
                            </td>
                            <td>
                                {{ $order->contact_email }}
                            </td>
                            <td>
                                {{ $order->contact_mobile }}
                            </td>
                            <td>
                                {{ $order->address }}
                            </td>
                            <td>
                                {!! Form::submit($order->orderType->type, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $order->orderType->color . '; width: 80px;']) !!}
                            </td>
                            <td>
                                @if($order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::CANCELED || $order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::SUCCESSFUL)
                                {!! Form::submit($order->orderAssignment->orderStatus->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $order->orderAssignment->orderStatus->color . '; width: 120px;']) !!}
                                @else
                                {!! Form::select('change_order_status_id', $orderStatuses, $order->orderAssignment->orderStatus->id, ['class' => 'form-control change_order_status_id', 'id' => 'change_order_status_id', 'orderAssignmentId' => $order->orderAssignment->id, 'orderDeadline' => date('m/d/y', strtotime($order->deadline)), 'style' => 'background-color:' . $order->orderAssignment->orderStatus->color . ';width: 120px;']) !!}
                                @endif
                            </td>
                            <td>
                                {{ ceil($order->amount) }} <b> {{ config('app_configuration.currency')}} </b>
                            </td>
                            <td>
                                {{ ceil($order->collected_amount) }} <b> {{ config('app_configuration.currency')}} </b>
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($order->deadline)) }}
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($order->created_at)) }}
                            </td>
                            <td>
                                @if($order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::CANCELED || $order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::SUCCESSFUL)
                                @elseif(!empty($order->orderAssignment->task))
                                {!! Form::select('agent_id', $agents->pluck('name', 'id')->prepend('Select agent...', null), $order->orderAssignment->task->assignedTo->id, ['class' => 'form-control agents', 'orderAssignmentId' => $order->orderAssignment->id, 'style' => 'width: 120px;']) !!}
                                @else
                                {!! Form::select('agent_id', $agents->pluck('name', 'id')->prepend('Select agent...', null), '', ['class' => 'form-control agents', 'orderAssignmentId' => $order->orderAssignment->id, 'style' => 'width: 120px;']) !!}
                                @endif

                            </td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm" href="{{ route('order.show', $order->id) }}" style="width: 80px;">
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
                {{ $orders->links() }}
            </div>
        </div>
    </section>
</div>

<!-- order status change modal -->

{!! Form::open(['route' => 'order.status.update', 'method' => 'post']) !!}

<div class="modal fade" id="orderStatusChangeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change order Status</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="modal-body text-center">
                        <p>Are you sure to change the order status.</p>
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

<div class="modal fade" id="rescheduleStatusModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Reschedule Order</h4>
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
                {!! Form::submit('Reschedule order', ['class' => 'btn btn-success']) !!}
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

<!-- agent select modal -->

<div class="modal fade" id="agentSelectModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Assign Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="modal-body text-center" id="message">

                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::open(['route' => 'assigne.agent', 'method' => 'post']) !!}
                {!! Form::hidden('agentId', '', ['id' => 'agentId']) !!}
                {!! Form::hidden('orderAssignmentId', '', ['id' => 'orderAssignmentId']) !!}
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::submit('Assign Order', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@endsection