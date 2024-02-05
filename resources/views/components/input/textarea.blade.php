@props(['name', 'label', 'value' => '', 'helper', 'data' => null, 'wrapId' => null, 'required'])

<div class="col-md-12">
    <div class="form-group" id="{{@$wrapId}}">
        <label class="form-control-label" for="input-{{$name}}">{{$label}} {{@$required ? "(*)" : ""}}</label>
        <textarea id="{{$name}}" name="{{$name}}" placeholder="{{$label}}" {{ $attributes->merge(['class' => " form-control ". ($errors->has($name) ? ' is-invalid' : '')]) }}>{{old($name) ?? $data[$name] ?? $value ?? ''}}</textarea>

        @if($errors->has($name))
        <div class="invalid-feedback">
            <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first($name) }}
        </div>
        @elseif(isset($helper))
        <small class="form-text text-muted">{{$helper}}</small>
        @endif
    </div>
</div>