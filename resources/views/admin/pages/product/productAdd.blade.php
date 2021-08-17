@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    @include('alert.flashAlert')
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => 'products.store', 'method' => 'post', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('productName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'productName', 'placeholder' => 'Enter product name', 'class' => 'form-control']) !!}
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
                                {!! Form::text('unit_price','', ['id' => 'productUnitPrice', 'placeholder' => 'Enter unit price', 'class' => 'form-control']) !!}
                                @error('unit_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productHeight', 'Height') !!}
                                {!! Form::text('height','', ['id' => 'productHeight', 'placeholder' => 'Enter height', 'class' => 'form-control']) !!}
                                @error('productHeight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWidth', 'Width') !!}
                                {!! Form::text('width','', ['id' => 'productHeight', 'placeholder' => 'Enter width', 'class' => 'form-control']) !!}
                                @error('width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWeight', 'Weight') !!}
                                {!! Form::text('weight','', ['id' => 'productWeight', 'placeholder' => 'Enter weight', 'class' => 'form-control']) !!}
                                @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productSize', 'Size') !!}
                                {!! Form::text('size','', ['id' => 'productSize', 'placeholder' => 'Enter size', 'class' => 'form-control']) !!}
                                @error('size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productStatus', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], 1, ['class' => 'form-control', 'id' => 'productStatus']) !!}
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
                                {!! Form::textarea('description','', ['id' => 'productDescription', 'placeholder' => 'Enter product description ...', 'class' => 'form-control', 'row' => '5']) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Add Product', ['class' => 'btn btn-success btn-sm']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

@endsection