@props(['name' => '', 'label' => '', 'value' => ''])

<div class="form-group" id="tv-{{$name}}">
    <strong>{{$label}} : </strong>
    {{ $value }}
</div>