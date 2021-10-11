@extends('app')

@section('customJs')
<script>
    $(function() {

        const getAreas = function(seller) {
            if (seller) {
                const getUrl = "{{ URL('merchant/areas') }}" + "/" + seller;
                $.ajax({
                    type: "GET",
                    url: getUrl,
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.code == 200) {
                            $("#contactArea").html(data.data);

                            console.log(data.data);
                        } else {
                            alert("Something went wrong. Please try again later.");
                        }
                    },
                    error: function() {
                        alert("Something went wrong. Please try again later.");
                    }
                });
            } else {
                $("#contactArea").html("");
            }
        }

        const getProducts = function() {


            if ($(this).val()) {
                const getUrl = "{{ URL('merchant/seller-product') }}" + "/" + $(this).val();
                $.ajax({
                    type: "GET",
                    url: getUrl,
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.code == 200) {
                            $("#seller-product").html(data.data);
                            console.log(data.data);
                        } else {
                            alert("Something went wrong. Please try again later.");
                        }
                    },
                    error: function() {
                        alert("Something went wrong. Please try again later.");
                    }
                });
            } else {
                $("#seller-product").html("");
            }
            getAreas($(this).val())
        }

        $("#seller").change(getProducts);
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
                    <h1>Add Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Order</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="container-fluid row mb-2">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- add section -->
    <section class="content">
        <div class="container-fluid">
            <!-- add order info section -->
            {!! Form::open(['route' => 'orders.store', 'method' => 'post', 'files' => true]) !!}
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Order Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('orderType', 'Order Type') !!}
                                {!! Form::select('order_type', $orderTypes->prepend('Select order type...', null), null, ['class' => 'form-control', 'id' => 'orderType']) !!}
                                @error('order_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="seller-div">
                                <label>Seller</label>
                                <select name="seller" id="seller" class="form-control">
                                    <option value="" selected>Select seller...</option>
                                    @foreach($sellers as $seller)
                                    @php
                                    $imgpath = $seller->avatar ? '/storage/' . $seller->avatar : 'img/dummy-user.png';
                                    @endphp
                                    <option value="{{ $seller->id }}" data-img-src="{{ asset($imgpath) }}">
                                        {{ $seller->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('seller')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" id="seller-product">
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
            <!-- add product info section -->
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Product Information</h3>
                        </div>
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
            <!-- add contact info section -->
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
                            <div id="contactArea"></div>
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
                                {!! Form::textarea('instruction','', ['id' => 'instruction', 'placeholder' => 'Enter instruction...', 'class' => 'form-control', 'rows' => 2]) !!}
                                @error('instruction')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('note', 'Note') !!}
                                {!! Form::textarea('note','', ['id' => 'note', 'placeholder' => 'Enter note...', 'class' => 'form-control', 'rows' => 2]) !!}
                                @error('note')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- footer section-->
                        <div class="card-footer">
                            {!! Form::submit('Place order', ['class' => 'btn btn-success']) !!}
                            <a class="btn btn-secondary" href="{{ route('orders.index') }}">
                                </i>
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
</div>

@endsection