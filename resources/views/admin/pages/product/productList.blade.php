@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
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
        </div><!-- /.container-fluid -->
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('productName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'productName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoryName', 'Category') !!}
                            {!! Form::select('category_id', [null => 'Select category'] + $categories->toArray(), old('category_id'), ['class' => 'form-control', 'id' => 'categoryName', ]) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('productStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select status', App\Constant\StatusTypeConst::ACTIVE => 'Active', App\Constant\StatusTypeConst::INACTIVE => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'productStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('createdAtDateRange', 'Select Created At Date Range') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                                </div>
                                {!! Form::text('createdAtDateRange', old('createdAtDateRange'), ['id' => 'createdAtDateRange', 'class' => 'form-control float-right dateRange']) !!}
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
    </section>

    <!-- error message -->
    <section class="content">
        <div class="row mb-2">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- product list section -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Product List</h3>

                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('products.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add Product
                    </a>

                    @php
                    $product_ids = $products->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('product.export', $product_ids) }}" style="width: 150px;">
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
                                Sl#
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
                            <th>
                                Status
                            </th>
                            <th>
                                Created Time
                            </th>
                            <th>
                                Updated Time
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($products->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @php
                        $serial = 1;
                        @endphp

                        @foreach($products as $product)
                        <tr>
                            <td>
                                {{ $serial }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                            <td>
                                {{ $product->category->name }}
                            </td>
                            <td>
                                @php
                                $serial++;
                                $imgpath = $product->image ? '/storage/' . $product->image : 'img/dummy-product.jpg';
                                @endphp
                                <img src="{{ asset($imgpath) }}" alt="Image not found" style="height:80px; width:80px;">
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
                            <td style="width: 200px;">
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
        </div>
    </section>
</div>

@endsection