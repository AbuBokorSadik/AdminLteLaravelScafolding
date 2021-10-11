@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Category List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- filter section -->
    <section class="content">
        <div class="card">
            {!! Form::open(['route' => 'categories.index', 'method' => 'get']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoryName', 'Name') !!}
                            {!! Form::text('name', old('name'), ['id' => 'categoryName', 'placeholder' => 'Enter name...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoryAlias', 'Alias') !!}
                            {!! Form::text('alias', old('alias'), ['id' => 'categoryAlias', 'placeholder' => 'Enter alias...', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoryStatus', 'Status') !!}
                            {!! Form::select('status', [null => 'Select status...', App\Constant\StatusTypeConst::ACTIVE => 'Active', App\Constant\StatusTypeConst::INACTIVE => 'Inactive'], old('status'), ['class' => 'form-control', 'id' => 'categoryStatus', ]) !!}
                        </div>
                    </div>
                    <div class="col-sm-3">
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

    <!-- category list section -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>
                <div class="card-tools">
                    <a class="btn btn-success" href="{{ route('categories.create') }}" style="width: 150px;">
                        <i class="fas fa-plus"></i>
                        Add Category
                    </a>

                    @php
                    $category_ids = $categories->pluck('id');
                    @endphp
                    <a class="btn btn-info" href="{{ route('category.export', $category_ids) }}" style="width: 150px;">
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
                                Alias
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
                        @if ($categories->isEmpty())
                        <tr>
                            <td colspan="100%">No data found!!!</td>
                        </tr>
                        @endif

                        @php
                        $serial = 1;
                        @endphp

                        @foreach($categories as $category)
                        <tr>
                            <td>
                                {{ $serial }}
                                @php
                                $serial++;
                                @endphp
                            </td>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                {{ $category->alias }}
                            </td>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-{{ ($category->status) ? 'success' : 'danger' }}" style="width: 60px;">
                                    {{ ($category->status) ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                {{ $category->created_at }}
                            </td>
                            <td>
                                {{ $category->updated_at }}
                            </td>
                            <td style="width: 200px;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a class="btn btn-info btn-sm" href="categories/{{$category->id}}/edit" style="width: 80px;">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete']) !!}
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
                {{ $categories->links() }}
            </div>
        </div>
    </section>
</div>

@endsection