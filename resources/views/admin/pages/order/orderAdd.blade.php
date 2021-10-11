@extends('app')

@section('customJs')
<script>
    $(function() {
        const getOrderType = function(){
            if ($(this).val()) {
                    const getUrl = "{{ URL('admin/order-types') }}" + "/" + $(this).val();
                    $.ajax({
                        type: "GET",
                        url: getUrl,
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.code == 200) {
                                $("#add-orderType").html(data.data);
                                console.log(data.data);
                            } else {
                                alert("Something went wrong. Please try again later.");
                            }
                        },
                        error: function() {
                            alert("Something went wrong. Please try again later.");
                        }
                    });
                }
        }

        const getProduct = function() {
            if ($(this).val()) {
                let product_id = $(this).val();
                let product_exist = false;
                $(".product_quantity").each(function() {
                    if (product_id == $(this).attr("product_id")) {
                        product_exist = true;
                    }

                });
                // console.log("product exist: " + product_exist);
                if (!product_exist) {
                    const getUrl = "{{ URL('admin/product') }}" + "/" + $(this).val();
                    $.ajax({
                        type: "GET",
                        url: getUrl,
                        success: function(response) {
                            const data = JSON.parse(response);
                            if (data.code == 200) {
                                $("#add_product").append(data.data);
                                console.log(data.data);
                            } else {
                                alert("Something went wrong. Please try again later.");
                            }
                        },
                        error: function() {
                            alert("Something went wrong. Please try again later.");
                        }
                    });
                }
            }
        }

        $("#buyerId").change(getOrderType);
        $("#product").change(getProduct);
    });
</script>
@endsection

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
            {!! Form::open(['route' => 'order.store', 'method' => 'post', 'files' => true]) !!}
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
                            <div class="form-group" id="seller-div">
                                <label>Buyer</label>
                                <select name="buyerId" id="buyerId" class="form-control">
                                    <option value="" selected>Select buyer...</option>
                                    @foreach($buyers as $buyer)
                                    @php
                                    $imgpath = $buyer->avater ? '/storage/' . $buyer->avater : 'img/dummy-user.png';
                                    @endphp
                                    <option value="{{ $buyer->id }}" data-img-src="{{ asset($imgpath) }}">
                                        {{ $buyer->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('buyerId')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div id="add-orderType">
                                <!-- order type goes here-->
                            </div>
                            <div class="form-group">
                                {!! Form::label('product', 'Product') !!}
                                {!! Form::select('product', $products->prepend('Select product...', null), null, ['class' => 'form-control', 'id' => 'product']) !!}
                                @error('product')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="add_product">
                                <!-- seller product goes here-->
                            </div>
                            <div class="form-group">
                                {!! Form::label('amount', 'Amount') !!}
                                {!! Form::number('amount', 0, ['id' => 'amount', 'placeholder' => 'Enter amount...', 'class' => 'form-control', 'readonly',]) !!}
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('serviceCharge', 'Service Charge') !!}
                                {!! Form::number('serviceCharge', 0, ['id' => 'serviceCharge', 'placeholder' => 'Enter service charge...', 'class' => 'form-control', 'readonly',]) !!}
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('deadlineDate', 'Select Deadline') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-clock"></i></span>
                                    </div>
                                    {!! Form::text('deadline', '', ['class' => 'form-control float-right deadlineDate']) !!}
                                </div>
                                @error('deadline')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('reference_id', 'Reference ID') !!}
                                {!! Form::text('reference_id','', ['id' => 'reference_id', 'placeholder' => 'Enter reference id...', 'class' => 'form-control']) !!}
                                @error('reference_id')
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
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'name', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::text('email','', ['id' => 'email', 'placeholder' => 'Enter email...', 'class' => 'form-control']) !!}
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('mobile', 'Mobile') !!}
                                {!! Form::text('mobile','', ['id' => 'mobile', 'placeholder' => 'Enter mobile...', 'class' => 'form-control']) !!}
                                @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('area_id', 'Area') !!}
                                {!! Form::select('area_id', $areas->prepend('Select contact area...', null), null, ['class' => 'form-control', 'id' => 'area_id']) !!}
                                @error('product')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('address', 'Address') !!}
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

                <a class="btn btn-secondary btn-sm" href="{{ route('order.index') }}">
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