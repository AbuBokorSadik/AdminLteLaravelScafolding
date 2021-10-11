@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>
            </div>

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

    <!-- add section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        {!! Form::open(['route' => 'products.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('productName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'productName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Category') !!}
                                {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'id' => 'category']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('productUnitPrice', 'Unit Price') !!}
                                {!! Form::text('unit_price','', ['id' => 'productUnitPrice', 'placeholder' => 'Enter unit price...', 'class' => 'form-control']) !!}
                                @error('unit_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productHeight', 'Height') !!}
                                {!! Form::text('height','', ['id' => 'productHeight', 'placeholder' => 'Enter height...', 'class' => 'form-control']) !!}
                                @error('productHeight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWidth', 'Width') !!}
                                {!! Form::text('width','', ['id' => 'productHeight', 'placeholder' => 'Enter width...', 'class' => 'form-control']) !!}
                                @error('width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWeight', 'Weight') !!}
                                {!! Form::text('weight','', ['id' => 'productWeight', 'placeholder' => 'Enter weight...', 'class' => 'form-control']) !!}
                                @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productSize', 'Size') !!}
                                {!! Form::text('size','', ['id' => 'productSize', 'placeholder' => 'Enter size...', 'class' => 'form-control']) !!}
                                @error('size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productMeasurementUnit', 'Measurement Unit') !!}
                                {!! Form::text('measurement_unit','', ['id' => 'productMeasurementUnit', 'placeholder' => 'Enter measurement unit...', 'class' => 'form-control']) !!}
                                @error('measurement_unit')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productStatus', 'Status') !!}
                                {!! Form::select('status', [App\Constant\StatusTypeConst::ACTIVE => 'Active', App\Constant\StatusTypeConst::INACTIVE => 'Inactive'], App\Constant\StatusTypeConst::ACTIVE, ['class' => 'form-control', 'id' => 'productStatus']) !!}
                            </div>
                            <div class="custom-file">
                                {!! Form::file('image', ['id' => 'chooseFile', 'class' => 'custom-file-input']) !!}
                                {!! Form::label('chooseFile', 'Select image file', ['class' => 'custom-file-label']) !!}
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productDescription', 'Description') !!}
                                {!! Form::textarea('description','', ['id' => 'productDescription', 'placeholder' => 'Enter description ...', 'class' => 'form-control', 'rows' => '2']) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Add Product', ['class' => 'btn btn-success']) !!}
                            <a class="btn btn-secondary" href="{{ route('products.index') }}">
                                </i>
                                Cancel
                            </a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection