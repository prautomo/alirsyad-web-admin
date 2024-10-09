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

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-showUpdate">Tampilkan Update Di Halaman Home</label>

            <select id="showUpdate" name="showUpdate" class="form-control {{($errors->has('showUpdate') ? ' is-invalid' : '')}}">
                @foreach($showUpdate as $val => $label)
                <option value="{{ $val }}" {{ ((int)$val===0) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            @if($errors->has('showUpdate'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('showUpdate') }}
            </div>
            @endif
        </div>
    </div>

    <!-- Visibilitas Materi --> 
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-isVisible">Visibilitas Materi</label>

            <select id="isVisible" name="is_visible" class="form-control {{($errors->has('isVisible') ? ' is-invalid' : '')}}">
                <option value="0" {{ @$data->is_visible==0 ? "selected " : "" }}>Sembunyikan</option>
                <option value="1" {{ @$data ? (@$data->is_visible== 1 ? "selected " : "") : "selected"}}>Tampilkan</option>
            </select>

            @if($errors->has('isVisible'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('isVisible') }}
            </div>
            @endif
        </div>
    </div>
    <!-- END Visibilitas Materi -->

    <!-- Is Sub Materi --> 
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-isSubbab">Jenis Materi</label>

            <select id="isSubbab" name="is_subbab" class="form-control {{($errors->has('isSubbab') ? ' is-invalid' : '')}}">
                <option value="0" {{ @$data->is_subbab==0 ? "selected " : "" }}>BAB</option>
                <option value="1" {{ @$data ? (@$data->is_subbab== 1 ? "selected " : "") : "selected"}}>SUB BAB</option>
            </select>

            @if($errors->has('isSubbab'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('isSubbab') }}
            </div>
            @endif
        </div>
    </div>
    <!-- END Visibilitas Materi -->

    <x-input.images :label="__('Upload Cover Update')" wrapId="coverUpdate" name="cover_update" :data="@$update" :default="@$update->logo ? asset(@$update->logo) : asset('images/placeholder.png')" required />

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

        var coverUpdate = $("#coverUpdate");
        coverUpdate.hide();

        @if(@$update->logo && @$data->show_update)
            $("#showUpdate option[value='1']").prop('selected',true);
            coverUpdate.show();
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

    $('select#showUpdate').on('change', function() {
        var coverUpdate = $("#coverUpdate");
        if(this.value==1){
            // show upload cover update
            coverUpdate.show();
        }else{
            // hide upload cover update
            coverUpdate.hide();
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
