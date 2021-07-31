@csrf
<div class="row">
    <x-input.textarea :label="__('Caption')" name="caption" :data="$data" required />
    <x-input.textarea :label="__('Caption Desc')" name="caption_desc" :data="$data" required />
    <x-input.text :label="__('Banner Button Label')" name="banner_button_label" :data="$data" required />
    <x-input.images :label="__('Image')" name="image_url" :data="$data" required />
    <x-input.text :label="__('Action Type')" name="action_type" :data="$data" required />
    <x-input.text :label="__('Action Params')" name="action_params" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::banners.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>
