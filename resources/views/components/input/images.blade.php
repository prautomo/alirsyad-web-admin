@props(['name', 'label', 'value' => '', 'helper', 'data' => null, 'wrapId' => null, 'width' => '100%', 'height' => '100%', 'default' => asset('images/placeholder.png'), 'required'])

@php
$default = (@$data[$name]) ? asset($data[$name]) : $default;
@endphp

<div class="col-md-12" id="{{@$wrapId}}">
    <div class="form-group">
        <label class="form-control-label" for="input-{{$name}}">{{$label}} {{@$required ? "(*)" : ""}}</label>
        <input id="{{$name}}" type="file" name="{{$name}}" placeholder="{{$label}}" value="{{old($name) ?? $data[$name] ?? $value ?? ''}}" {{ $attributes->merge(['class' => " form-control ". ($errors->has($name) ? ' is-invalid' : '')]) }} accept="image/bmp, image/jpeg, image/x-png, image/png, image/gif" >

        @if(@$errors->has($name))
        <div class="invalid-feedback">
            <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first($name) }}
        </div>
        @elseif(isset($helper))
        <small class="form-text text-muted">{{$helper}}</small>
        @endif
        <img id="img-preview-{{$name}}" src="{{ $default }}" width="{{ $width }}" height="{{ $height }}" />
    </div>
</div>

@push('script')
<script type="text/javascript">
$("#{{$name}}").change(function (event) {
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview-{{$name}}').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
