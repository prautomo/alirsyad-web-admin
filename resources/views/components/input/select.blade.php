@props(['name', 'label', 'value' => '', 'wrappingId' => '' , 'helper', 'data' => null, 'sources' => [], 'required'])

<div class="col-md-12" id="{{$wrappingId}}">
    <div class="form-group">
        <label class="form-control-label" for="input-{{$name}}">{{$label}} {{@$required ? "(*)" : ""}}</label>

        <select id="{{$name}}" name="{{$name}}" {{ $attributes->merge(['class' => " form-control ". ($errors->has($name) ? ' is-invalid' : '')]) }}>
            @forelse($sources as $k => $sc)
                <option value="{{ $k }}"{{ !empty($data[$name]) ? ($data[$name]==$k) ? ' selected' : '' : '' }}>{{ $sc }}</option>
            @empty
            <option>None</option>
            @endforelse
        </select>

        @if($errors->has($name))
        <div class="invalid-feedback">
            <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first($name) }}
        </div>
        @elseif(isset($helper))
        <small class="form-text text-muted">{{$helper}}</small>
        @endif
    </div>
</div>
