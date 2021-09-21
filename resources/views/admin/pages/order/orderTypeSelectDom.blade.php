<div class="form-group">
    {!! Form::label('orderType', 'Order Type') !!}
    {!! Form::select('orderType', $orderTypes->prepend('Select order type...', null), null, ['class' => 'form-control', 'id' => 'orderType']) !!}
    @error('orderType')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>