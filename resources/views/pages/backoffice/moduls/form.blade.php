@csrf
<div class="row">
    <x-input.select :label="__('Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" required />

    <div class="col-md-12">
        <div class="form-group">
            @if(@$data)
            <label class="form-control-label" for="input-modul">File Modul</label>
            @else
            <label class="form-control-label" for="input-modul">File Modul (*)</label>
            @endif
            <input id="modul" type="file" accept="application/pdf" name="modul" placeholder="File Modul" value="{{old('modul') ?? $data['modul'] ?? '' ?? ''}}" class="form-control {{($errors->has('modul') ? ' is-invalid' : '')}}" }}>

            @if($errors->has('modul'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('modul') }}
            </div>
            @endif
            
            <div id="pdf-viewer-modul"></div>
        </div>
    </div>

    <x-input.select :label="__('Semester')" id="semester" name="semester" :sources="$semesterList" :data="$data" required />

    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />
    <x-input.images :label="__('Cover Modul')" name="icon" :data="$data" />
    <x-input.text :label="__('Tahun Ajaran')" name="tahun_ajaran" :data="$data" />
    <x-input.text type="number" :label="__('Urutan')" name="urutan" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::moduls.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#mata_pelajaran_id').select2();

        @if(@$data->pdf_path)
            let template = "<object type='application/pdf' width='100%' height='400px' data= '{{ asset($data->pdf_path) }}'>";
            
            $('#pdf-viewer-modul').html(template);
        @endif
    });

    $('#modul').on('change', function(e){ 
        let files = e.target?.files ?? [];
        
        if (files.length >= 1) {
            let fileUrl = URL.createObjectURL(files[0]);
            let template = "<object type='application/pdf' width='100%' height='400px' data= '" + fileUrl + "'>";
            
            $('#pdf-viewer-modul').html(template);
        }
    });
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush