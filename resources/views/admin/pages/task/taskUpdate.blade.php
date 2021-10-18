@extends('app')

@section('contentWrapper')

<div class="content-wrapper">
    <!-- header section -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Task Update</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- error message -->
    <section class="content">
        <div class="row mb-2 container-fluid">
            <div class="col-sm-4">
                @include('alert.flashAlert')
            </div>
        </div>
    </section>

    <!-- task update section -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Task Update</h3>
                        </div>
                        {!! Form::open(['route' => ['tasks.update', $task->id], 'method' => 'put', 'files' => true]) !!}
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Ref Id</b> </p>
                                                </div>
                                                <div class="col-4">
                                                    {!! Form::text('ref_id', $task->ref_id , ['placeholder' => 'Enter ref id...', 'class' => 'form-control']) !!}
                                                    @error('ref_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Deadline</b> </p>
                                                </div>
                                                <div class="col-4">
                                                    {!! Form::text('deadline', date('m/d/y', strtotime($task->deadline)), ['class' => 'form-control float-right deadlineDate']) !!}
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Contact email</b> </p>
                                                </div>
                                                <div class="col-4">
                                                    {!! Form::text('contact_email', $task->contact_email, ['placeholder' => 'Enter contact email...', 'class' => 'form-control']) !!}
                                                    @error('contact_email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Contact mobile</b> </p>
                                                </div>
                                                <div class="col-4">
                                                    {!! Form::text('contact_mobile', $task->contact_mobile, ['placeholder' => 'Enter contact mobile number...', 'class' => 'form-control']) !!}
                                                    @error('contact_mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <p>{{ $task->addditional_mobile }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Contact address</b> </p>
                                                </div>
                                                <div class="col-4">
                                                    {!! Form::text('contact_address', $task->contact_address, ['placeholder' => 'Enter contact address number...', 'class' => 'form-control']) !!}
                                                    @error('contact_address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <p>{{ $task->addditional_address }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Instruction</b> </p>
                                                </div>
                                                <div class="col">
                                                    {!! Form::textarea('instruction', $task->instruction , ['placeholder' => 'Enter instruction...', 'class' => 'form-control', 'rows' => 2]) !!}
                                                    @error('instruction')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-2">
                                                    <p><b>Note</b> </p>
                                                </div>
                                                <div class="col">
                                                    {!! Form::textarea('note', $task->note, ['placeholder' => 'Enter note...', 'class' => 'form-control', 'rows' => 2]) !!}
                                                    @error('note')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {!! Form::submit('Update Task', ['class' => 'btn btn-success']) !!}
                            <a class="btn btn-secondary" href="{{ route('tasks.index') }}">
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