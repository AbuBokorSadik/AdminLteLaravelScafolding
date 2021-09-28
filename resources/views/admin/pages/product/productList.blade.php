@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
            {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('productId', 'Id') !!}
                            {!! Form::text('id', old('id'), ['id' => 'productId', 'placeholder' => 'Enter product id...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('productName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'productName', 'placeholder' => 'Enter product name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoryName', 'Category') !!}
                            {!! Form::select('category_id', [null => 'Select product category'] + $categories->toArray(), old('category_id'), ['class' => 'form-control', 'id' => 'categoryName', ]) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('productStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select product status', '1' => 'Active', '0' => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'productStatus', ]) !!}
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('unitPrice', 'Unit Price') !!}
                            {!! Form::text('unit_price', old('unit_price'), ['id' => 'unitPrice']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('height', 'Height') !!}
                            {!! Form::text('height', old('height'), ['id' => 'height']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('width', 'Width') !!}
                            {!! Form::text('width', old('width'), ['id' => 'width']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('weight', 'Weight') !!}
                            {!! Form::text('weight', old('weight'), ['id' => 'weight']) !!}
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <!-- <div class="col-sm-3">
                        <div class="form-group">
                            {!! Form::label('size', 'Size') !!}
                            {!! Form::text('size', old('size'), ['id' => 'size']) !!}
                        </div>
                    </div> -->
                    <div class="col-sm-3">
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
                {!! Form::submit('Clear Filter', ['class' => 'btn btn-secondary', 'id' => 'clear' ]) !!}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>

                <div class="card-tools">
                    {!! Form::open(['route' => 'products.create', 'method' => 'get']) !!}
                    {!! Form::button('<i class="fas fa-plus fa-sm"> Add Product</i>', ['type'=>'submit', 'class' => 'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                Id
                            </th>
                            <th>
                                Name
                            </th>
                            <th>
                                Category
                            </th>
                            <th>
                                Image
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                Unit Price
                            </th>
                            <th>
                                Height
                            </th>
                            <th>
                                Width
                            </th>
                            <th>
                                Weight
                            </th>
                            <th>
                                Size
                            </th>
                            <th class="text-center">
                                Status
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Updated Time
                            </th>
                            <th class="text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->category->name }}
                            </td>
                            <td>
                                <img src="{{ asset('/storage/' . $product->image) }}" alt="Image not found" style="height:80px; width:80px;">
                            </td>
                            <td>
                                {{ $product->description }}
                            </td>
                            <td>
                                {{ $product->unit_price }}
                            </td>
                            <td>
                                {{ $product->height }}
                            </td>
                            <td>
                                {{ $product->width }}
                            </td>
                            <td>
                                {{ $product->weight }}
                            </td>
                            <td>
                                {{ $product->size }}
                            </td>
                            <td class="project-state">
                                <span class="badge badge-{{ ($product->status) ? 'success' : 'danger' }}" style="width: 60px;">
                                    {{ ($product->status) ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                {{ $product->created_at }}
                            </td>
                            <td>
                                {{ $product->updated_at }}
                            </td>
                            <td class="text-center" style="width: 200px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a class="btn btn-info btn-sm" href="products/{{$product->id}}/edit" style="width: 80px;">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fas fa-trash fa-sm"> Delete</i>', ['type'=>'submit', 'class' => 'btn btn-danger btn-sm', 'style' => 'width:80px']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                {{ $products->links() }}
            </div>

            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

@endsection