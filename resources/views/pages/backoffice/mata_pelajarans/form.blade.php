@csrf
<div class="row">
    <x-input.select :label="__('Tingkat')" id="tingkat_id" name="tingkat_id" :sources="$tingkatList" :data="$data" required />

    <!-- Dropdown Kelas -->
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-kelas">Kelas (*)</label>

            <select id="kelas" name="kelas_id" class="form-control {{($errors->has('kelas') ? ' is-invalid' : '')}}">
                <option value="" selected>Pilih kelas</option>
            </select>

            @if($errors->has('kelas'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('kelas') }}
            </div>
            @endif
        </div>
    </div>
    <!-- End dropdown kelas -->

    <!-- <x-input.text :label="__('Slug')" name="slug" :data="$data" /> -->
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    <x-input.images :label="__('Cover Image')" name="icon" :data="$data" />

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::mata_pelajarans.index")}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('script')
<script>
    $('select#tingkat_id').on('change', function() {
        loadKelas( this.value );
    });

    function loadKelas(tingkatId, selectedId){
        $.ajax({
            type:'GET',
            url:"{{route("backoffice::kelas.listJson")}}",
            data:"q_tingkat_id=" + tingkatId,
            success: function(res){ 
                for(var i=0; i<res.length; i++){
                    var kelas = res[i];
                    if(kelas.id==selectedId){
                        $('#kelas').append($('<option selected>').val(kelas.id).text(kelas.name));
                    }else{
                        $('#kelas').append($('<option>').val(kelas.id).text(kelas.name));
                    }
                }
            }
        }); 
    }

    // default select if edit
    @if($data)
    $(async function(){
        var tingkatId = "{{$data->kelas->tingkat_id}}";
        var kelasId = "{{$data->kelas_id}}";

        // select default tingkat
        $("select#tingkat_id").val(tingkatId);

        // load list kelas
        await loadKelas( tingkatId, kelasId );
    }); 
    @endif
</script>
@endpush