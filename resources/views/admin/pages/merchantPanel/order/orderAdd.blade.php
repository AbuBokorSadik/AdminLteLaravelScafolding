@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Order</li>
                    </ol>
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
            {!! Form::open(['route' => 'orders.store', 'method' => 'post', 'files' => true]) !!}
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Order Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('orderType', 'Order Type') !!}
                                {!! Form::select('order_type_id', $orderTypes, 1, ['class' => 'form-control', 'id' => 'orderType']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('seller', 'Seller') !!}
                                {!! Form::select('seller_id', $sellers->pluck('name', 'id'), 1, ['class' => 'form-control', 'id' => 'seller']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('amount', 'Amount') !!}
                                {!! Form::text('amount','', ['id' => 'amount', 'placeholder' => 'Enter amount...', 'class' => 'form-control']) !!}
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('deadlineDate', 'Select Deadline Date') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    {!! Form::text('deadline', '', ['id' => 'deadlineDate', 'class' => 'form-control float-right']) !!}
                                </div>
                                @error('deadline')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('ref_id', 'Reference ID') !!}
                                {!! Form::text('ref_id','', ['id' => 'ref_id', 'placeholder' => 'Enter reference id...', 'class' => 'form-control']) !!}
                                @error('ref_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Product Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('productWeight', 'Product Weight') !!}
                                {!! Form::text('product_weight','', ['id' => 'productWeight', 'placeholder' => 'Enter product weight...', 'class' => 'form-control']) !!}
                                @error('product_weight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productHeight', 'Product Height') !!}
                                {!! Form::text('product_height','', ['id' => 'productHeight', 'placeholder' => 'Enter product height...', 'class' => 'form-control']) !!}
                                @error('product_height')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productLength', 'Product Length') !!}
                                {!! Form::text('product_length','', ['id' => 'productLength', 'placeholder' => 'Enter product length...', 'class' => 'form-control']) !!}
                                @error('product_length')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWidth', 'Product Width') !!}
                                {!! Form::text('product_width','', ['id' => 'productWidth', 'placeholder' => 'Enter product width...', 'class' => 'form-control']) !!}
                                @error('product_width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Contact Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('name', 'Contact Name') !!}
                                {!! Form::text('name','', ['id' => 'name', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Contact Email') !!}
                                {!! Form::text('email','', ['id' => 'email', 'placeholder' => 'Enter email...', 'class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('mobile', 'Contact Mobile') !!}
                                {!! Form::text('mobile','', ['id' => 'mobile', 'placeholder' => 'Enter mobile...', 'class' => 'form-control']) !!}
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Contact Address') !!}
                                {!! Form::text('address','', ['id' => 'address', 'placeholder' => 'Enter address...', 'class' => 'form-control']) !!}
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('addressLat', 'Address Latitude') !!}
                                {!! Form::text('address_lat','', ['id' => 'addressLat', 'placeholder' => 'Enter address latitude...', 'class' => 'form-control']) !!}
                                @error('address_lat')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('addressLng', 'Address Longitude') !!}
                                {!! Form::text('address_lng','', ['id' => 'addressLng', 'placeholder' => 'Enter address longitude...', 'class' => 'form-control']) !!}
                                @error('address_lng')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('instruction', 'Instruction') !!}
                                {!! Form::textarea('instruction','', ['id' => 'instruction', 'placeholder' => 'Enter instruction...', 'class' => 'form-control', 'row' => '2']) !!}
                                @error('instruction')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('note', 'Note') !!}
                                {!! Form::textarea('note','', ['id' => 'note', 'placeholder' => 'Enter note...', 'class' => 'form-control', 'row' => '2']) !!}
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                {!! Form::submit('Place order', ['class' => 'btn btn-success btn-sm']) !!}

                <a class="btn btn-secondary btn-sm" href="{{ route('orders.index') }}">
                    </i>
                    Cancel
                </a>

            </div>
            {!! Form::close() !!}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection