@props(['name', 'type', 'step', 'label', 'value', 'placeholder' => '', 'helper', 'data' => null, 'required'])

@if(@$type!=='hidden')
<div class="col-md-12">
    <div class="form-group">
        <label class="form-control-label" for="input-{{$name}}">{{$label}} {{@$required ? "(*)" : ""}}</label>
        <input id="{{$name}}" type="{{@$type?$type:'text'}}" {!! @!empty($step) ? 'step="'.$step.'"' : "" !!} name="{{$name}}" placeholder="{{ @$placeholder ? $placeholder : $label}}" value="{{old($name) ?? $data[$name] ?? $value ?? ''}}" {{ $attributes->merge(['class' => " form-control ". ($errors->has($name) ? ' is-invalid' : '')]) }}>

        @if($errors->has($name))
        <div class="invalid-feedback">
            <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first($name) }}
        </div>
        @elseif(isset($helper))
        <small class="form-text text-muted">{{$helper}}</small>
        @endif
    </div>
</div>
@else
<input id="{{$name}}" type="{{@$type?$type:'text'}}" name="{{$name}}" placeholder="{{$label}}" value="{{old($name) ?? $data[$name] ?? $value ?? ''}}" {{ $attributes->merge(['class' => " form-control ". ($errors->has($name) ? ' is-invalid' : '')]) }}>
@endif
