@extends('app')

@section('customJs')
<script>
    $(function() {
        const cancelOrder = function() {
            $("#orderCancelModal").modal('show');
            $("#formOrderAssignmentId").val($(this).attr('orderAssignmentId'));
            $('#formOrderStatusId').val("{{ App\Constant\OrderStatusTypeConst::CANCELED }}");
            // alert($("#formOrderAssignmentId").val());
        }

        const orderPayment = function() {
            $("#orderPaymentModal").modal('show');
            $("#amount").val($(this).attr('amount'));
            $("#serviceCharge").val($(this).attr('serviceCharge'));
            $("#totalPayable").html("<b>Total Payable: " + $(this).attr('totalPayable') + " {{ config('app_configuration.currency')}} <b>");
            $("#orderAssignmentId").val($(this).attr('orderAssignmentId'));
            // alert($this.attr('totalPayable'));
            // $("#formOrderAssignmentId").val($(this).attr('orderAssignmentId'));
            // $('#formOrderStatusId').val("{{ App\Constant\OrderStatusTypeConst::CANCELED }}");
            // alert($("#formOrderAssignmentId").val());
        }

        $(".cancelOrder").click(cancelOrder);

        $(".orderPayment").click(orderPayment);
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
            {!! Form::open(['route' => 'orders.index', 'method' => 'get']) !!}
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
                            {!! Form::text('contact_name', old('contact_name'), ['id' => 'contactName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactEmail', 'Contact Email') !!}
                            {!! Form::text('contact_email', old('contact_email'), ['id' => 'contactEmail', 'placeholder' => 'Enter email...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contactMobile', 'Contact Mobile') !!}
                            {!! Form::text('contact_mobile', old('contact_mobile'), ['id' => 'contactMobile', 'placeholder' => 'Enter mobile...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            {!! Form::label('orderType', 'Order Type') !!}
                            {!! Form::select('order_type_id', [null => 'Select order type...', '1' => 'Pickup', '2' => 'Delivery'], old('order_type_id'), ['class' => 'form-control', 'id' => 'orderStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col-3">
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
                    <div class="col-3">
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
                    <a class="btn btn-success" href="{{ route('orders.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add order
                    </a>

                    @php
                    $order_ids = $orders->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('merchant.order.export', $order_ids) }}" style="width: 150px;">
                        <i class="fas fa-file-download"></i>
                        Export Excel
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-striped projects text-center" id="dataTable">
                    <thead>
                        <tr>
                            <th>
                                Sl#
                            </th>
                            <th>
                                Order Id
                            </th>
                            <th>
                                Seller Information
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
                            <th>
                                Payment
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($orders->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @php
                        $serial = 1;
                        @endphp
                        
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                {{ $serial }}
                            </td>
                            <td>
                                <span style="font-weight: bold; color: #3d9970;">
                                    {{ $order->order_id }}
                                </span>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{ $order->orderAssignment->assignedTo->name }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        {{ $order->orderAssignment->assignedTo->mobile }}
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
                                {!! Form::submit($order->orderAssignment->orderStatus->status, ['class' => 'btn btn-sm', 'style' => 'background-color:' . $order->orderAssignment->orderStatus->color . '; width: 80px;']) !!}
                            </td>
                            <td>
                                {{ ceil($order->amount) }} <b> {{ config('app_configuration.currency') }} </b>
                            </td>
                            <td>
                                @php
                                $serial++;
                                $service_charge = ceil($order->orderAssignment->service_charge + $order->orderAssignment->area_charge + $order->orderAssignment->weight_charge + $order->orderAssignment->delivery_type_charge);
                                $total_payable = ceil($order->amount + $service_charge);
                                @endphp
                                {{ $service_charge }} <b> {{ config('app_configuration.currency') }} </b>
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($order->deadline)) }}
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($order->created_at)) }}
                            </td>
                            <td class="text-center" style="width: 200px;">
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-info btn-sm" href="{{ route('orders.show', $order->id) }}" style="width: 80px;">
                                            <i class="fas fa-eye"></i>
                                            Show
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        @if($order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::PENDING)
                                        {!! Form::button('<i class="fas fa-trash fa-sm"> Cancel</i>', ['orderAssignmentId' => $order->orderAssignment->id, 'type'=>'submit', 'class' => 'btn btn-danger btn-sm cancelOrder', 'style' => 'width:80px;']) !!}
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($order->orderAssignment->payment == 'PAID')
                                {!! Form::button('<i class="fas fa-money-bill-wave">&nbsp;Done Payment</i>', ['type'=>'submit', 'class' => 'btn btn-success btn-sm']) !!}
                                @elseif($order->orderAssignment->current_order_status_id != App\Constant\OrderStatusTypeConst::CANCELED)
                                {!! Form::button('<i class="fas fa-money-bill-wave">&nbsp;Make Payment</i>', ['type'=>'submit', 'orderAssignmentId' => $order->orderAssignment->id, 'amount' => $order->amount, 'serviceCharge' => $service_charge, 'totalPayable' => $total_payable, 'class' => 'btn btn-danger btn-sm orderPayment']) !!}
                                @endif

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

<!-- order cancel modal -->
<div class="modal fade" id="orderCancelModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Cancel Order</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="form-group">
                <div class="card-body">
                    <div class="modal-body text-center">
                        <p>Are you sure to cancel the order.</p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::open(['route' => 'merchant.order.status.update', 'method' => 'post']) !!}
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::hidden('formOrderAssignmentId', '', ['id' => 'formOrderAssignmentId']) !!}
                {!! Form::hidden('formOrderStatusId', '', ['id' => 'formOrderStatusId']) !!}
                {!! Form::submit('Cancel order', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

<!-- payment modals -->
<div class="modal fade" id="orderPaymentModal">
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
                    <div class="row" style="margin-bottom: 4px;">
                        <div class="col-4">
                            <p><b>Amount</b></p>
                        </div>
                        <div class="col">
                            {!! Form::number('amount', null, ['id' => 'amount', 'placeholder' => 'Enter amount...', 'class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-2">
                            <b> {{ config('app_configuration.currency')}} </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p><b>Service Charge</b></p>
                        </div>
                        <div class="col">
                            {!! Form::number('service_charge', null, ['id' => 'serviceCharge', 'placeholder' => 'Enter service charge...', 'class' => 'form-control', 'readonly']) !!}
                        </div>
                        <div class="col-2">
                            <b> {{ config('app_configuration.currency')}} </b>
                        </div>
                    </div>
                    <br><br>
                    <div class="text-center">
                        <p id="totalPayable"></p>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                {!! Form::open(['route' => 'order.payment', 'method' => 'post']) !!}
                {!! Form::submit('Close', ['class' => 'btn btn-danger', 'data-dismiss' => 'modal', ]) !!}
                {!! Form::hidden('orderAssignmentId', '', ['id' => 'orderAssignmentId']) !!}
                {!! Form::submit('Confirm payment', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@endsection