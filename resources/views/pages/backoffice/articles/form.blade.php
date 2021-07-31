@csrf
<div class="row">
    <x-input.text :label="__('Slug')" name="slug" :data="$data" />
    <x-input.images :label="__('Cover Image')" name="cover_image" :data="$data"/>
    <x-input.text :label="__('Title')" name="title" :data="$data" required />
    <x-input.textarea :label="__('Content')" name="content" :data="$data" required />
    <x-input.text :label="__('Author')" name="author" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::articles.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>