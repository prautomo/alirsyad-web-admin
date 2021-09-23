@csrf
<div class="row">
    <x-input.select :label="__('Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" required />
    
    <x-input.select :label="__('Semester')" id="semester" name="semester" :sources="$semesterList" :data="$data" required />

    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.text :label="__('URL Youtube Video')" name="video_url" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />
    <x-input.images :label="__('Cover Video')" name="icon" :data="$data" />
    <x-input.text type="number" :label="__('Urutan')" name="urutan" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::videos.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>

@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#mata_pelajaran_id').select2();
    });
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush