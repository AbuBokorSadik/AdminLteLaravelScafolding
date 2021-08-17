@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    @include('alert.flashAlert')
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md">
                    <!-- general form elements -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
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
                            {!! Form::submit('Add Category', ['class' => 'btn btn-success btn-sm']) !!}
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