@csrf
<div class="row">
    <x-input.select :label="__('Jenjang')" id="jenjang_id" name="jenjang_id" :sources="$jenjangList" :data="$data" />
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.images :label="__('Logo')" name="logo" :data="$data" />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::tingkats.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>
