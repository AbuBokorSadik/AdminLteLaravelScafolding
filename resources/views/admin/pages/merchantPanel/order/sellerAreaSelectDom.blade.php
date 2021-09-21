<div class="form-group">
    {!! Form::label('area', 'Contact Area') !!}
    {!! Form::select('area', $areas->prepend('Select area...', null), null, ['class' => 'form-control', 'id' => 'area']) !!}
    @error('area')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>