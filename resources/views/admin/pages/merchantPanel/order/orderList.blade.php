@extends('app')

@section('customJs')
<script>
    $(function() {
        const cancelOrder = function() {
            $("#orderCancelModal").modal('show');
            $("#formOrderAssignmentId").val($(this).attr('orderAssignmentId'));
            // alert($("#formOrderAssignmentId").val());
        }

        $(".cancelOrder").click(cancelOrder);
    });
</script>
@endsection

@section('contentWrapper')

<div class="content-wrapper">
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
            {!! Form::open(['route' => 'orders.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('id', 'Id') !!}
                            {!! Form::text('id', old('id'), ['id' => 'id', 'placeholder' => 'Enter id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('orderId', 'Order Id') !!}
                            {!! Form::text('order_id', old('order_id'), ['id' => 'orderId', 'placeholder' => 'Enter order id...', 'class' => 'form-control']) !!}
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
                            {!! Form::label('orderType', 'Order Type') !!}
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
                                {!! Form::text('deadlineDateRange', old('deadlineDateRange'), ['id' => 'deadlineDateRange', 'class' => 'form-control float-right']) !!}
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
                                {!! Form::text('createdAtDateRange', old('createdAtDateRange'), ['id' => 'createdAtDateRange', 'class' => 'form-control float-right']) !!}
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
                <h3 class="card-title">Order List</h3>
                <div class="card-tools">
                    {!! Form::open(['route' => 'orders.create', 'method' => 'get']) !!}
                    {!! Form::button('<i class="fas fa-plus"> Add order</i>', ['type'=>'submit', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects text-center" id="dataTable">
                    <thead>
                        <tr>
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
                        @foreach($orders as $order)
                        <tr>
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
                                {{ date('d M, Y', strtotime($order->deadline)) }}
                            </td>
                            <td>
                                {{ date('d M, Y', strtotime($order->created_at)) }}
                            </td>
                            <td class="text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <a class="btn btn-info btn-sm" href="{{ route('orders.show', $order->id) }}" style="width: 80px;">
                                            <i class="fas fa-eye"></i>
                                            Show
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        @if($order->orderAssignment->orderStatus->id == App\Constant\OrderStatusTypeConst::PENDING)
                                        {!! Form::button('<i class="fas fa-trash fa-sm"> Cancel</i>', ['orderAssignmentId' => $order->orderAssignment->id, 'type'=>'submit', 'class' => 'btn btn-danger btn-sm cancelOrder', 'style' => 'width:80px']) !!}
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $orders->links() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

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
                {!! Form::submit('Cancel order', ['class' => 'btn btn-success']) !!}
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@endsection