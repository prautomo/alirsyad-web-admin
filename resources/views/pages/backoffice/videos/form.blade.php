@csrf
<div class="row">
    <x-input.select :label="__('Modul')" id="modul_id" name="modul_id" :sources="$modulList" :data="$data" />

    <!-- Dropdown Mata Pelajaran -->
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-mapel">Mata Pelajaran (*)</label>

            <select id="mapel" {{ @$data->modul_id ? "disabled " : "" }}name="mata_pelajaran_id" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                @foreach($mapelList as $k => $sc)
                    @if(@$data->mata_pelajaran_id === $k)
                    <option value="{{@$k}}" selected>{{ @$sc }}</option>
                    @else
                    <option value="{{@$k}}">{{ @$sc }}</option>
                    @endif
                @endforeach
            </select>

            @if($errors->has('mapel'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('mapel') }}
            </div>
            @endif
        </div>
    </div>
    <!-- End dropdown Mata Pelajaran -->

    <x-input.select :label="__('Semester')" id="semester" name="semester" :sources="$semesterList" :data="$data" required />

    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.text type="number" :label="__('Urutan')" name="urutan" :data="$data" required />
    <x-input.text :label="__('URL Youtube Video')" name="video_url" :data="$data" required />
    <x-input.textarea :label="__('Description')" name="description" :data="$data" />

    <!-- Visible VIdeo -->
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-mapel">Tampilkan Video</label>

            <select id="visible" name="visible" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                <option value="ya" {{ @$data->visible==1 ? "selected " : ""}}>Ya</option>
                <option value="tidak" {{ @$data->visible==0 ? "selected " : ""}}>Tidak</option>
            </select>

            @if($errors->has('visible'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('visible') }}
            </div>
            @endif
        </div>
    </div>
    <!-- End Visible VIdeo -->

    <x-input.images :label="__('Cover Video')" name="icon" :data="$data" />

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

    <x-input.images :label="__('Upload Cover Update')" wrapId="coverUpdate" name="cover_update" :data="$data" required />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::videos.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>

@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modul_id').select2();
        $('#mapel').select2();

        var coverUpdate = $("#coverUpdate");
        coverUpdate.hide();
    });

    $('select#showUpdate').on('change', function() {
        var coverUpdate = $("#coverUpdate");
        if(this.value){
            // show upload cover update
            coverUpdate.show();
        }else{
            // hide upload cover update
            coverUpdate.hide();
        }
    });

    $('select#modul_id').on('change', function() {
        var mapel = $("#mapel");
        if(this.value){
            console.log( this.value );
            autoFillMapel(this.value);
            $('#mapel').select2();
            $("#mapel").select2('destroy');
            mapel.prop('disabled', 'disabled');
        }else{
            $('#mapel').select2();
            mapel.prop('disabled', false);
        }
    });

    async function autoFillMapel(idModul){
        var mapel = $("#mapel");

        // find mapel id by modul
        let detailModul = await loadDetailModul(idModul);

        let mapelID = detailModul?.mata_pelajaran_id ?? "";
        console.log("dika detailModul", detailModul)

        $("select#mapel option").filter(function() {
            //may want to use $.trim in here
            return $(this).val() == mapelID;
        }).prop('selected', true);
    }

    async function loadDetailModul(modulId){
        let result = null;
        await $.ajax({
            type:'GET',
            url:"{{route("backoffice::json.modul")}}",
            data:"q_id=" + modulId,
            success: function(res){
                if(res?.data?.length > 0){
                    result = res?.data[0];
                }
            }
        });

        return result;
    }
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
