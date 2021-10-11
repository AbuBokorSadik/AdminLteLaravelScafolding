@extends('app')

@section('contentWrapper')
<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- error message -->
    <section class="content">
        <div class="container-fluid row mb-2">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- update section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Update Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'put']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('categoryName', 'Name') !!}
                                {!! Form::text('name', $category->name, ['id' => 'categoryName', 'placeholder' => 'Enter category name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('categoryAlias', 'Alias') !!}
                                {!! Form::text('alias', $category->alias, ['id' => 'categoryalias', 'placeholder' => 'Enter alias name', 'class' => 'form-control']) !!}
                                @error('alias')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('categoryStatus', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], $category->status, ['class' => 'form-control', 'id' => 'categoryStatus']) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Update Category', ['class' => 'btn btn-success']) !!}

                            <a class="btn btn-secondary" href="{{ route('categories.index') }}">
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