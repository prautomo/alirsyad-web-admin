@csrf
<div class="row">
    <x-input.text :label="__('Slug')" name="slug" :data="$data" />
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" required />
    <x-input.images :label="__('Image')" :width="__('250px')" :height="__('250px')" name="images" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::brands.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>