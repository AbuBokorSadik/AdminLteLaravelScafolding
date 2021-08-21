@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Product</li>
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
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Update Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['products.update', $product->id], 'method' => 'put']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('productName', 'Name') !!}
                                {!! Form::text('name', $product->name, ['id' => 'productName', 'placeholder' => 'Enter product name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('category', 'Category') !!}
                                {!! Form::select('category_id', $categories, $product->category->id, ['class' => 'form-control', 'id' => 'category']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('productUnitPrice', 'Unit Price') !!}
                                {!! Form::text('unit_price', $product->unit_price, ['id' => 'productUnitPrice', 'placeholder' => 'Enter unit price', 'class' => 'form-control']) !!}
                                @error('unit_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productHeight', 'Height') !!}
                                {!! Form::text('height', $product->height, ['id' => 'productHeight', 'placeholder' => 'Enter height', 'class' => 'form-control']) !!}
                                @error('productHeight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWidth', 'Width') !!}
                                {!! Form::text('width', $product->width, ['id' => 'productHeight', 'placeholder' => 'Enter width', 'class' => 'form-control']) !!}
                                @error('width')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productWeight', 'Weight') !!}
                                {!! Form::text('weight', $product->weight, ['id' => 'productWeight', 'placeholder' => 'Enter weight', 'class' => 'form-control']) !!}
                                @error('weight')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productSize', 'Size') !!}
                                {!! Form::text('size', $product->size, ['id' => 'productSize', 'placeholder' => 'Enter size', 'class' => 'form-control']) !!}
                                @error('size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('productStatus', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], $product->status, ['class' => 'form-control', 'id' => 'productStatus']) !!}
                            </div>
                            <div class="row form-group">
                                <div class="col-6">
                                    {!! Form::file('image', ['id' => 'chooseFile', 'class' => 'custom-file-input']) !!}
                                    {!! Form::label('chooseFile', $product->image, ['class' => 'custom-file-label']) !!}
                                </div>
                                <div class="col">
                                    @if(!empty(asset('/storage/' . $product->image)))
                                    <img src="{{ asset('/storage/' . $product->image) }}" alt="Image not found" style="width:100px">
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('productDescription', 'Description') !!}
                                {!! Form::textarea('description', $product->description, ['id' => 'productDescription', 'placeholder' => 'Enter product description ...', 'class' => 'form-control', 'row' => '5']) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Update Product', ['class' => 'btn btn-success btn-sm']) !!}
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