@csrf
<div class="row">
    <x-input.select :label="__('Mata Pelajaran')" id="mata_pelajaran_id" name="mata_pelajaran_id" :sources="$mapelList" :data="$data" onchange="clickMapel(this)" required />

    
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-bab">Bab (*)</label>

            <select id="bab" name="bab[]" class="form-control {{($errors->has('bab') ? ' is-invalid' : '')}}" >
                
            </select>

            @if($errors->has('bab'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('bab') }}
            </div>
            @endif
        </div>
    </div>

    <x-input.text :label="__('Subbab')" name="subbab" :data="$data" :placeholder="__('Nomor Subbab (contoh: 1)')" required />
    <x-input.text :label="__('Judul Subbab')" name="judul_subbab" :placeholder="__('Judul Subbab (contoh: Fauna Air)')" :data="$data" required/>

    {{-- <x-input.select :label="__('Tingkat Kesulitan')" id="tingkat_kesulitan" name="tingkat_kesulitan" :sources="$levelList" :data="$data" required /> --}}
    
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label">Tingkat Kesulitan (*)</label>
            <select name="tingkat_kesulitan" class="form-control">
                <option selected>Pilih tingkat kesulitan</option>
                <option value="mudah">Mudah</option>
                <option value="sedang">Sedang</option>
                <option value="sulit">Sulit</option>
            </select>
        </div>
    </div>

    <x-input.text type="number" :label="__('Jumlah Publish')" name="jumlah_publish" :data="$data" />
    <x-input.text type="number" :label="__('Nilai KKM')" name="nilai_kkm" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::latihan-soal.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('plugin_script')
<script type="text/javascript">

    function clickMapel(e){
        var bab = <?php echo json_encode($groupBabList); ?>;
        $('#bab').prop('disabled', false);

        var mata_pelajaran = $( "#mata_pelajaran_id option:selected" ).text();
        console.log(mata_pelajaran)

        var bab_show = bab.filter(function (bab) {
            return bab.text == mata_pelajaran;
        });

        $('#bab').empty();

        var s2 = $('#bab').select2({
            placeholder: "Please select modul",
            allowClear: true,
            width: '100%',
            data: bab_show,
            theme: "classic",
        });
    }

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

    $(document).ready(function() {
        var bab = <?php echo json_encode($groupBabList); ?>

        $('#bab').prop('disabled', false);

        var mata_pelajaran = $( "#mata_pelajaran_id option:selected" ).text();

        var bab_show = bab.filter(function (bab) {
            return bab.text == mata_pelajaran;
        });

        $('#bab').empty();

        var s2 = $('#bab').select2({
            placeholder: "Please select modul",
            allowClear: true,
            width: '100%',
            data: bab_show,
            theme: "classic",
        });
    });

</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
