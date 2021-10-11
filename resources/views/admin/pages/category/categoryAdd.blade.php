@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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

    <!-- add section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        {!! Form::open(['route' => 'categories.store', 'method' => 'post']) !!}
                        <div class="card-body">
                            <div class="form-group">
                                {!! Form::label('categoryName', 'Name') !!}
                                {!! Form::text('name','', ['id' => 'categoryName', 'placeholder' => 'Enter category name', 'class' => 'form-control']) !!}
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('categoryAlias', 'Alias') !!}
                                {!! Form::text('alias','', ['id' => 'categoryalias', 'placeholder' => 'Enter alias name', 'class' => 'form-control']) !!}
                                @error('alias')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('categoryStatus', 'Status') !!}
                                {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], 1, ['class' => 'form-control', 'id' => 'categoryStatus']) !!}
                            </div>
                        </div>

                        <div class="card-footer">
                            {!! Form::submit('Add Category', ['class' => 'btn btn-success']) !!}
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