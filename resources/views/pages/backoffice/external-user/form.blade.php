@csrf
<div class="row">
    @php
    $data['role'] = empty($data) ? \Request::get('role', 'SISWA') : $data['role']; 
    @endphp
    <x-input.text :label="__('Role')" type="hidden" name="role" :data="$data" />
    @if(\Request::get('role') === 'SISWA')
    <x-input.text :label="__('NIS')" name="nis" :data="$data" required />
    @else
    <x-input.text :label="__('NIP')" name="nis" :data="$data" required />
    @endif
    <x-input.text :label="__('Name')" name="name" :data="$data" required />
    

    @if(\Request::get('role') === 'SISWA')
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
    @endif

    <x-input.text :label="__('Username')" name="username" :data="$data" required />
    @if(empty(@$data['password']))
    <x-input.text :label="__('Password')" type="password" name="password" :data="$data" required />
    @endif
    <x-input.text :label="__('Email')" type="email" name="email" :data="$data" required />
    
    @if(\Request::get('role') === 'GURU' || @$mapelIDS)
    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-mapel">Mata Pelajaran</label>

            <select id="chooseMapel" multiple="multiple" name="mapel[]" class="form-control {{($errors->has('mapel') ? ' is-invalid' : '')}}">
                @foreach(@$mapelList as $idx => $mapel)

                @if(in_array($idx, $mapelIDS))
                <option value="{{ $idx }}" selected="true">{{ $mapel }}</option>
                @else
                <option value="{{ $idx }}">{{ $mapel }}</option>
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

    <div class="col-md-12">
        <div class="form-group">
            <label class="form-control-label" for="input-is_uploader">Guru Uploader</label>

            <select{{ ((int)1==(int) @$data['is_uploader']) ? ' disabled' : '' }} id="is_uploader" name="is_uploader" class="form-control {{($errors->has('is_uploader') ? ' is-invalid' : '')}}">
                @foreach(@$isUploader as $val => $label)
                <option value="{{ $val }}" {{ ((int)$val==(int) @$data['is_uploader']) ? ' selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            @if($errors->has('is_uploader'))
            <div class="invalid-feedback">
                <i class="fa fa-exclamation-circle fa-fw"></i> {{ $errors->first('is_uploader') }}
            </div>
            @endif
        </div>
    </div>
    @endif
    <x-input.text :label="__('Phone')" name="phone" :data="$data" />
    <x-input.textarea :label="__('Address')" name="address" :data="$data" />
    <x-input.images :label="__('Photo')" name="photo" :data="$data"/>

    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
        <button type="submit" class="btn btn-sm btn-primary">@lang("Save")</button>
        <a href="{{route("backoffice::external-users.index", ['role' => $data['role']])}}" class="btn btn-sm btn-secondary mr-2">@lang("Cancel")</a>
    </div>
</div>


@push('script')
@if(\Request::get('role') === 'SISWA')
<script>
    $('select#tingkat_id').on('change', function() {
        if(this.value){
            loadKelas( this.value );
        }
    });

    function loadKelas(tingkatId, selectedId){
        $.ajax({
            type:'GET',
            url:"{{route("backoffice::kelas.listJson")}}",
            data:"q_tingkat_id=" + tingkatId,
            success: function(res){ 
                $('#kelas').html("");
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
    @if(Request::segment(3)!=='create')
    $(async function(){
        
        var tingkatId = "{{@$data->kelas->tingkat_id}}";
        var kelasId = "{{@$data->kelas_id}}";

        // select default tingkat
        $("select#tingkat_id").val(tingkatId);

        // load list kelas
        if(tingkatId){
            await loadKelas( tingkatId, kelasId );
        }
    }); 
    @endif
</script>
@endif
@endpush


@push('plugin_script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#tingkat_id').select2();

        @if(\Request::get('role') === 'GURU' || @$mapelIDS)
            // $('#chooseMapel').select2({
            //     theme: "classic",
            //     width: 'resolve',
            // });
        @endif
    });
</script>
@endpush

@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('plugin_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    li.select2-results__option strong.select2-results__group:hover {
        background-color: #ddd;
        cursor: pointer;
    }
</style>
@endpush